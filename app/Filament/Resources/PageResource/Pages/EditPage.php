<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

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
