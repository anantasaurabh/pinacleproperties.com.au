<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('save')
                ->label('Save changes')
                ->color('primary')
                ->action('save'),
            Actions\Action::make('cancel')
                ->label('Cancel')
                ->color('secondary')
                ->url($this->getResource()::getUrl('index')),
        ];
    }

    protected function getFormActions(): array
    {
        return [];
    }
}
