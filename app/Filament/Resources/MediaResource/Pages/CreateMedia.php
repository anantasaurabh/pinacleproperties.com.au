<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMedia extends CreateRecord
{
    protected static string $resource = MediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->getCreateFormAction(),
            $this->getCancelFormAction(),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),
            $this->getCancelFormAction(),
        ];
    }

}
