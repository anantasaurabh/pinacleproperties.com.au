<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListMedia extends ListRecords
{
    protected static string $resource = MediaResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            MediaResource\Widgets\MediaUploadWidget::class,
        ];
    }

    protected function getListeners(): array
    {
        return [
            'refresh-media-list' => '$refresh',
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'image' => Tab::make('Images')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('file_type', 'image')),
            'video' => Tab::make('Videos')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('file_type', 'video')),
            'document' => Tab::make('Documents')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('file_type', 'document')),
        ];
    }
}
