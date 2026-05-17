<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NavItemResource\Pages;
use App\Models\NavItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NavItemResource extends Resource
{
    protected static ?string $model = NavItem::class;
    protected static ?string $navigationIcon = 'heroicon-o-bars-3';
    protected static ?string $navigationLabel = 'Navigation';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('label')
                    ->required()
                    ->label('Menu Label'),
                Forms\Components\TextInput::make('link')
                    ->required()
                    ->label('URL / Route'),
            ]),
            Forms\Components\Grid::make(3)->schema([
                Forms\Components\Select::make('location')
                    ->required()
                    ->options([
                        'header'              => 'Header',
                        'footer_quick_links'  => 'Footer – Quick Links',
                        'footer_company'      => 'Footer – Company',
                    ])
                    ->default('header'),
                Forms\Components\Select::make('target')
                    ->options([
                        '_self'  => 'Same Tab',
                        '_blank' => 'New Tab',
                    ])
                    ->default('_self'),
                Forms\Components\TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->label('Order'),
            ]),
            Forms\Components\Toggle::make('is_active')
                ->label('Active')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('link')->searchable(),
                Tables\Columns\BadgeColumn::make('location')
                    ->colors([
                        'primary'   => 'header',
                        'success'   => 'footer_quick_links',
                        'warning'   => 'footer_company',
                    ]),
                Tables\Columns\TextColumn::make('sort_order')->numeric()->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('location')
                    ->options([
                        'header'             => 'Header',
                        'footer_quick_links' => 'Footer – Quick Links',
                        'footer_company'     => 'Footer – Company',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListNavItems::route('/'),
            'create' => Pages\CreateNavItem::route('/create'),
            'edit'   => Pages\EditNavItem::route('/{record}/edit'),
        ];
    }
}
