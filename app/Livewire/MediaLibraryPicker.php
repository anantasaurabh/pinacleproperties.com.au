<?php

namespace App\Livewire;

use App\Models\Media;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class MediaLibraryPicker extends Component implements HasForms
{
    use InteractsWithForms;
    use WithFileUploads;

    public string $statePath = '';
    public string $activeTab = 'images';
    public ?array $uploadData = [];
    public string $search = '';

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('file_path')
                    ->label('File')
                    ->required()
                    ->directory('media')
                    ->preserveFilenames()
                    ->live()
                    ->afterStateUpdated(function (Forms\Set $set, $state) {
                        if ($state instanceof TemporaryUploadedFile) {
                            $set('title', pathinfo($state->getClientOriginalName(), PATHINFO_FILENAME));
                            $mime = $state->getMimeType();
                            $type = 'document';
                            if (str_starts_with($mime, 'image/')) $type = 'image';
                            elseif (str_starts_with($mime, 'video/')) $type = 'video';
                            $set('file_type', $type);
                        }
                    }),
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\Hidden::make('file_type'),
            ])
            ->statePath('uploadData');
    }

    public function selectMedia(string $filePath): void
    {
        $this->dispatch('media-selected', statePath: $this->statePath, filePath: $filePath);
        
        // Dispatch to close ANY open filament modal via standard Livewire event
        $this->dispatch('close-modal'); 
    }

    public function saveUpload(): void
    {
        $data = $this->form->getState();
        
        $media = Media::create([
            'title' => $data['title'],
            'file_path' => $data['file_path'],
            'file_type' => $data['file_type'],
            'disk' => 'public',
        ]);

        $this->selectMedia($media->file_path);
    }

    public function getMediaProperty()
    {
        $query = Media::query();
        
        if ($this->activeTab === 'images') {
            $query->where('file_type', 'image');
        } elseif ($this->activeTab === 'files') {
            $query->where('file_type', '!=', 'image');
        }

        if ($this->search) {
            $query->where('title', 'like', "%{$this->search}%");
        }

        return $query->latest()->get();
    }

    public function render()
    {
        return view('livewire.media-library-picker');
    }
}
