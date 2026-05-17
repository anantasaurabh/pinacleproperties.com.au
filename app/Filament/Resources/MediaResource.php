<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Filament\Resources\MediaResource\RelationManagers;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Upload Media')
                    ->schema([
                        Forms\Components\FileUpload::make('file_path')
                            ->label('File')
                            ->required()
                            ->directory('media')
                            ->preserveFilenames()
                            ->acceptedFileTypes([
                                'image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml',
                                'video/mp4', 'video/quicktime', 'video/x-msvideo', 'video/x-ms-wmv',
                                'application/pdf', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/csv'
                            ])
                            ->imageEditor()
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
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('title')
                                ->required(),
                            Forms\Components\TextInput::make('file_type')
                                ->label('Detected Type')
                                ->readOnly()
                                ->required(),
                        ]),
                        Forms\Components\Hidden::make('disk')->default('public'),
                        Forms\Components\Hidden::make('file_size'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('file_path')
                    ->label('Preview')
                    ->disk('public')
                    ->visibility(fn ($record) => $record->file_type === 'image')
                    ->square(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'image' => 'success',
                        'video' => 'warning',
                        'document' => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('file_type')
                    ->options([
                        'image' => 'Images',
                        'video' => 'Videos',
                        'document' => 'Documents',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('copy_url')
                    ->label('Copy URL')
                    ->icon('heroicon-o-clipboard')
                    ->color('gray')
                    ->action(fn () => null) // Handled by JS
                    ->extraAttributes(fn ($record) => [
                        'onclick' => "navigator.clipboard.writeText('" . \Storage::url($record->file_path) . "'); window.Filament.notify('success', 'URL Copied!')",
                    ]),
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('info')
                    ->url(fn ($record) => \Storage::url($record->file_path), shouldOpenInNewTab: true),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
        ];
    }
}
