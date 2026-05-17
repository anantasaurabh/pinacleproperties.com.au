<?php

namespace App\Filament\Resources\NavItemResource\Pages;

use App\Filament\Resources\NavItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListNavItems extends ListRecords
{
    protected static string $resource = NavItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'header' => Tab::make('Header')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('location', 'header')),
            'footer_quick_links' => Tab::make('Quick Links')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('location', 'footer_quick_links')),
            'footer_company' => Tab::make('Company')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('location', 'footer_company')),
        ];
    }
}
