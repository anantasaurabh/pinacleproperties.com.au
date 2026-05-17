<?php

namespace App\Filament\Resources\NavItemResource\Pages;

use App\Filament\Resources\NavItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNavItem extends EditRecord
{
    protected static string $resource = NavItemResource::class;

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
