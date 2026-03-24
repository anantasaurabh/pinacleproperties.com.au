<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Page')
                ->tabs([
                    // ── PAGE INFO ──────────────────────────────────────────
                    Forms\Components\Tabs\Tab::make('Page Info')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, Forms\Set $set) =>
                                        $set('slug', Str::slug($state))),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(Page::class, 'slug', ignoreRecord: true),
                            ]),
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Published')
                                    ->default(true),
                                Forms\Components\TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0)
                                    ->label('Sort Order'),
                            ]),
                        ]),

                    // ── SEO ────────────────────────────────────────────────
                    Forms\Components\Tabs\Tab::make('SEO')
                        ->icon('heroicon-o-magnifying-glass')
                        ->schema([
                            Forms\Components\TextInput::make('meta_title')
                                ->label('Meta Title'),
                            Forms\Components\Textarea::make('meta_description')
                                ->label('Meta Description')
                                ->rows(3)
                                ->columnSpanFull(),
                            Forms\Components\TextInput::make('meta_keywords')
                                ->label('Meta Keywords (comma separated)'),
                        ]),

                    // ── HERO ───────────────────────────────────────────────
                    Forms\Components\Tabs\Tab::make('Hero Section')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            Forms\Components\Section::make('Hero')->relationship('hero')->schema([
                                Forms\Components\Toggle::make('is_active')->label('Active')->default(true),
                                Forms\Components\Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('title')->label('Hero Title'),
                                    Forms\Components\TextInput::make('subtitle')->label('Subtitle'),
                                ]),
                                Forms\Components\Repeater::make('buttons')
                                    ->label('Buttons')
                                    ->schema([
                                        Forms\Components\TextInput::make('text')->label('Button Text')->required(),
                                        Forms\Components\TextInput::make('link')->label('Button URL')->required(),
                                    ])
                                    ->columns(2)
                                    ->defaultItems(1)
                                    ->addActionLabel('Add Button'),
                                Forms\Components\Grid::make(2)->schema([
                                    Forms\Components\FileUpload::make('image')
                                        ->label('Hero Image')
                                        ->image()
                                        ->directory('pages/hero'),
                                    Forms\Components\TextInput::make('video')->label('Video URL'),
                                ]),
                            ]),
                        ]),

                    // ── SECTIONS ───────────────────────────────────────────
                    Forms\Components\Tabs\Tab::make('Sections')
                        ->icon('heroicon-o-rectangle-stack')
                        ->schema([
                            Forms\Components\Repeater::make('sections')
                                ->relationship('sections')
                                ->label('Page Sections')
                                ->schema([
                                    Forms\Components\Toggle::make('is_active')->label('Active')->default(true)->inline(false),
                                    Forms\Components\Grid::make(2)->schema([
                                        Forms\Components\TextInput::make('kicker_text')->label('Kicker Text'),
                                        Forms\Components\TextInput::make('title')->label('Section Title'),
                                    ]),
                                    Forms\Components\Textarea::make('lead_text')->label('Lead Text')->rows(2),
                                    Forms\Components\RichEditor::make('content')
                                        ->label('Content (WYSIWYG)')
                                        ->fileAttachmentsDirectory('pages/sections')
                                        ->columnSpanFull(),
                                    Forms\Components\Select::make('layout')
                                        ->label('Block Layout')
                                        ->options([
                                            'small-image'   => 'Small Image',
                                            'large-image'   => 'Large Image',
                                            'list'          => 'List',
                                            'list-numbered' => 'Numbered List',
                                            'grid'          => 'Grid',
                                            'grid-numbered' => 'Numbered Grid',
                                            'slider'        => 'Slider',
                                            'tabs'          => 'Tabs',
                                            'faq'           => 'FAQ Accordion',
                                        ])
                                        ->default('grid'),
                                    Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                                    Forms\Components\Repeater::make('links')
                                        ->label('Section Links/Buttons')
                                        ->schema([
                                            Forms\Components\TextInput::make('text')->label('Link Text')->required(),
                                            Forms\Components\TextInput::make('link')->label('URL')->required(),
                                        ])
                                        ->columns(2)
                                        ->addActionLabel('Add Link')
                                        ->defaultItems(0),
                                    // Nested blocks
                                    Forms\Components\Repeater::make('blocks')
                                        ->relationship('blocks')
                                        ->label('Content Blocks')
                                        ->schema([
                                            Forms\Components\Toggle::make('is_active')->label('Active')->default(true)->inline(false),
                                            Forms\Components\Grid::make(2)->schema([
                                                Forms\Components\TextInput::make('title')->label('Block Title'),
                                                Forms\Components\TextInput::make('icon')->label('Icon Class (e.g. fa-solid fa-star)'),
                                            ]),
                                            Forms\Components\Textarea::make('content')->label('Block Content')->rows(3),
                                            Forms\Components\Grid::make(2)->schema([
                                                Forms\Components\FileUpload::make('image')
                                                    ->label('Block Image')
                                                    ->image()
                                                    ->directory('pages/blocks'),
                                                Forms\Components\Select::make('columns_per_row')
                                                    ->label('Columns Per Row')
                                                    ->options([2 => '2', 3 => '3', 4 => '4', 6 => '6'])
                                                    ->default(3),
                                            ]),
                                            Forms\Components\Grid::make(2)->schema([
                                                Forms\Components\TextInput::make('button_text')->label('Button Text'),
                                                Forms\Components\TextInput::make('button_link')->label('Button URL'),
                                            ]),
                                            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                                        ])
                                        ->addActionLabel('Add Block')
                                        ->defaultItems(0)
                                        ->collapsible(),
                                ])
                                ->addActionLabel('Add Section')
                                ->collapsible()
                                ->defaultItems(0),
                        ]),

                    // ── CTA ────────────────────────────────────────────────
                    Forms\Components\Tabs\Tab::make('CTA Section')
                        ->icon('heroicon-o-megaphone')
                        ->schema([
                            Forms\Components\Section::make('Call to Action')->relationship('cta')->schema([
                                Forms\Components\Toggle::make('is_active')->label('Active')->default(true),
                                Forms\Components\Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('title')->label('CTA Title'),
                                    Forms\Components\TextInput::make('subtitle')->label('CTA Subtitle'),
                                ]),
                                Forms\Components\Repeater::make('buttons')
                                    ->label('CTA Buttons')
                                    ->schema([
                                        Forms\Components\TextInput::make('text')->label('Button Text')->required(),
                                        Forms\Components\TextInput::make('link')->label('Button URL')->required(),
                                    ])
                                    ->columns(2)
                                    ->addActionLabel('Add Button')
                                    ->defaultItems(1),
                                Forms\Components\FileUpload::make('image')
                                    ->label('CTA Image')
                                    ->image()
                                    ->directory('pages/cta'),
                            ]),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Published'),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Published'),
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
            ->defaultSort('sort_order');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit'   => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
