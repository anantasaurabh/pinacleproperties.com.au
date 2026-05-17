<?php

namespace App\Filament\Resources\MediaResource\Widgets;

use App\Models\Media;
use App\Filament\Resources\MediaResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Widgets\Widget;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Filament\Notifications\Notification;

class MediaUploadWidget extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.resources.media-resource.widgets.media-upload-widget';

    protected int | string | array $columnSpan = 'full';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Quick Upload')
                    ->description('Upload images, videos or documents directly to the library.')
                    ->schema([
                        Forms\Components\FileUpload::make('file_path')
                            ->label('File')
                            ->required()
                            ->directory('media')
                            ->preserveFilenames()
                            ->live()
                            ->afterStateUpdated(function (Forms\Set $set, $state) {
                                $file = is_array($state) ? head($state) : $state;
                                
                                if ($file instanceof TemporaryUploadedFile) {
                                    $set('title', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                                    
                                    $mime = $file->getMimeType();
                                    $type = 'document';
                                    if (str_starts_with($mime, 'image/')) $type = 'image';
                                    elseif (str_starts_with($mime, 'video/')) $type = 'video';
                                    
                                    $set('file_type', $type);
                                }
                            }),
                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\TextInput::make('title')
                                ->required(),
                            Forms\Components\TextInput::make('file_type')
                                ->label('Detected Type')
                                ->readOnly()
                                ->required(),
                            Forms\Components\Actions::make([
                                Forms\Components\Actions\Action::make('save')
                                    ->label('Save to Library')
                                    ->action('create')
                                    ->color('warning')
                                    ->size('lg')
                                    ->extraAttributes([
                                        'class' => 'w-full',
                                        'style' => 'margin-top: 28px;',
                                    ]),
                            ])
                            ->alignEnd(),
                        ]),
                        Forms\Components\Hidden::make('disk')->default('public'),
                        Forms\Components\Hidden::make('file_size'),
                    ])->compact(),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
        
        Media::create($data);

        $this->form->fill();

        Notification::make()
            ->title('Media saved successfully')
            ->success()
            ->send();

        $this->dispatch('refresh-media-list');
    }
}
