<?php

namespace App\Filament\Resources\OpportunityResource\Pages;

use App\Filament\Resources\OpportunityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOpportunity extends EditRecord
{
    protected static string $resource = OpportunityResource::class;

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
