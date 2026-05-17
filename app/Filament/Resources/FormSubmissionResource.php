<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormSubmissionResource\Pages;
use App\Models\FormSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FormSubmissionResource extends Resource
{
    protected static ?string $model = FormSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Form Submissions';
    protected static ?string $navigationGroup = 'Forms';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('form_name')
                    ->disabled(),
                Forms\Components\Select::make('status')
                    ->options([
                        'new' => 'New',
                        'read' => 'Read',
                        'processed' => 'Processed',
                    ])
                    ->required(),
                Forms\Components\KeyValue::make('data')
                    ->columnSpanFull()
                    ->disabled(),
                Forms\Components\Section::make('Metadata')
                    ->schema([
                        Forms\Components\TextInput::make('ip_address')->disabled(),
                        Forms\Components\TextInput::make('user_agent')->disabled(),
                        Forms\Components\DateTimePicker::make('created_at')->disabled(),
                    ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('form_name')
                    ->searchable()
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'danger',
                        'read' => 'warning',
                        'processed' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Submitted At'),
                Tables\Columns\TextColumn::make('ip_address')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'read' => 'Read',
                        'processed' => 'Processed',
                    ]),
                Tables\Filters\SelectFilter::make('form_name')
                    ->options(fn () => FormSubmission::distinct()->pluck('form_name', 'form_name')->toArray()),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFormSubmissions::route('/'),
        ];
    }
}
