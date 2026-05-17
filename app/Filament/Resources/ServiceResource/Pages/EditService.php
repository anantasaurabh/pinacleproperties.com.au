<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

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
