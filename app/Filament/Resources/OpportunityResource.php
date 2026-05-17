<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OpportunityResource\Pages;
use App\Models\Opportunity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OpportunityResource extends Resource
{
    protected static ?string $model = Opportunity::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'House & Land Packages';
    protected static ?string $modelLabel = 'House & Land Package';
    protected static ?string $pluralModelLabel = 'House & Land Packages';
    protected static ?string $slug = 'house-and-land-packages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General Information')
                    ->description('Primary details and settings for the package')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('location')
                                    ->label('General Location')
                                    ->placeholder('e.g. Tarneit, VIC')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('price_range')
                                    ->label('Price Display Text')
                                    ->placeholder('e.g. From $650,000')
                                    ->maxLength(255),
                                Forms\Components\Select::make('status')
                                    ->options([
                                        'Available' => 'Available',
                                        'Sold' => 'Sold',
                                        'Under Offer' => 'Under Offer',
                                    ])
                                    ->default('Available')
                                    ->required(),
                                Forms\Components\Select::make('agent_id')
                                    ->relationship('agent', 'name')
                                    ->label('Assigned Agent')
                                    ->placeholder('Select an agent')
                                    ->nullable(),
                                Forms\Components\TextInput::make('link')
                                    ->label('External Details Link')
                                    ->placeholder('Optional link for external website')
                                    ->maxLength(255),
                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Featured Package')
                                    ->default(false),
                            ]),
                        Forms\Components\Textarea::make('short_description')
                            ->label('Short Sub-headline / Description')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->label('Full Description')
                            ->rows(8)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Package Specifications')
                    ->description('Specifications like beds, baths, dimensions, and location particulars')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('bed')
                                    ->numeric()
                                    ->label('Bedrooms')
                                    ->placeholder('e.g. 4'),
                                Forms\Components\TextInput::make('bath')
                                    ->numeric()
                                    ->label('Bathrooms')
                                    ->placeholder('e.g. 2'),
                                Forms\Components\TextInput::make('garage')
                                    ->numeric()
                                    ->label('Garage Spaces')
                                    ->placeholder('e.g. 2'),
                                Forms\Components\Select::make('storeys')
                                    ->label('Storeys')
                                    ->options([
                                        'Single' => 'Single Storey',
                                        'Double' => 'Double Storey',
                                    ])
                                    ->placeholder('Select Storeys')
                                    ->nullable(),
                                Forms\Components\TextInput::make('area')
                                    ->label('Home Area')
                                    ->placeholder('e.g. 180 sqm'),
                                Forms\Components\TextInput::make('block_area')
                                    ->label('Block Area')
                                    ->placeholder('e.g. 400 sqm'),
                                Forms\Components\TextInput::make('block_width')
                                    ->label('Block Width')
                                    ->placeholder('e.g. 12.5m'),
                                Forms\Components\TextInput::make('block_depth')
                                    ->label('Block Depth')
                                    ->placeholder('e.g. 28m'),
                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->label('Price Value (for filters)')
                                    ->placeholder('e.g. 650000'),
                                Forms\Components\Select::make('country')
                                    ->label('State (QLD/VIC)')
                                    ->options([
                                        'QLD' => 'QLD',
                                        'VIC' => 'VIC',
                                    ])
                                    ->placeholder('Select State')
                                    ->live()
                                    ->nullable(),
                                Forms\Components\Select::make('suburb')
                                    ->label('Suburb')
                                    ->options(function (callable $get) {
                                        $state = $get('country');
                                        $query = Opportunity::query()->whereNotNull('suburb')->where('suburb', '!=', '');
                                        if ($state) {
                                            $query->where('country', $state);
                                        }
                                        return $query->distinct()->pluck('suburb', 'suburb')->toArray();
                                    })
                                    ->searchable()
                                    ->placeholder('Select Suburb')
                                    ->live()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('new_suburb')
                                            ->required()
                                            ->label('New Suburb Name'),
                                    ])
                                    ->createOptionUsing(fn (array $data) => $data['new_suburb']),
                                Forms\Components\Select::make('estate')
                                    ->label('Estate')
                                    ->options(function (callable $get) {
                                        $suburb = $get('suburb');
                                        $query = Opportunity::query()->whereNotNull('estate')->where('estate', '!=', '');
                                        if ($suburb) {
                                            $query->where('suburb', $suburb);
                                        }
                                        return $query->distinct()->pluck('estate', 'estate')->toArray();
                                    })
                                    ->searchable()
                                    ->placeholder('Select Estate')
                                    ->live()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('new_estate')
                                            ->required()
                                            ->label('New Estate Name'),
                                    ])
                                    ->createOptionUsing(fn (array $data) => $data['new_estate']),
                            ]),
                    ]),

                Forms\Components\Section::make('Images, Plan & Brochure')
                    ->description('Upload structural plans, galleries, and brochures')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->image()
                                    ->directory('packages/featured')
                                    ->label('Featured Image'),
                                Forms\Components\FileUpload::make('plan_image')
                                    ->image()
                                    ->directory('packages/plans')
                                    ->label('Floor Plan Image'),
                                Forms\Components\FileUpload::make('images')
                                    ->image()
                                    ->multiple()
                                    ->directory('packages/gallery')
                                    ->label('Gallery Images')
                                    ->columnSpanFull(),
                                Forms\Components\FileUpload::make('brochure_pdf')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->directory('packages/brochures')
                                    ->label('Brochure PDF (Upload)')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                Forms\Components\Section::make('Map Details')
                    ->description('Geographical coordination and address details')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('address')
                                    ->label('Location / Map Address')
                                    ->placeholder('e.g. 123 Collins St, Melbourne VIC 3000')
                                    ->columnSpan(2),
                                Forms\Components\TextInput::make('map_lat')
                                    ->numeric()
                                    ->label('Latitude')
                                    ->nullable(),
                                Forms\Components\TextInput::make('map_lng')
                                    ->numeric()
                                    ->label('Longitude')
                                    ->nullable(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Featured'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estate')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('suburb')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('country')
                    ->label('State')
                    ->sortable(),
                Tables\Columns\TextColumn::make('storeys')
                    ->label('Storeys')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_range')
                    ->label('Price range')
                    ->searchable(),
                Tables\Columns\TextColumn::make('agent.name')
                    ->label('Agent')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Available' => 'success',
                        'Under Offer' => 'warning',
                        'Sold' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('country')
                    ->label('State')
                    ->options([
                        'QLD' => 'QLD',
                        'VIC' => 'VIC',
                    ]),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured Only'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOpportunities::route('/'),
            'create' => Pages\CreateOpportunity::route('/create'),
            'edit' => Pages\EditOpportunity::route('/{record}/edit'),
        ];
    }
}
