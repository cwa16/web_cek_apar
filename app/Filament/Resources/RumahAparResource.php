<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RumahAparResource\Pages;
use App\Filament\Resources\RumahAparResource\RelationManagers;
use App\Models\RumahApar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RumahAparResource extends Resource
{
    protected static ?string $model = RumahApar::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_rumah_apar')
                ->required(),
                Forms\Components\TextInput::make('lokasi')
                ->required(),
                Forms\Components\TextInput::make('dept')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_rumah_apar')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('lokasi')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('dept')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            // RelationManagers\RumahAparResource::getRelations()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRumahApars::route('/'),
            'create' => Pages\CreateRumahApar::route('/create'),
            'view' => Pages\ViewRumahApar::route('/{record}'),
            'edit' => Pages\EditRumahApar::route('/{record}/edit'),
        ];
    }
}
