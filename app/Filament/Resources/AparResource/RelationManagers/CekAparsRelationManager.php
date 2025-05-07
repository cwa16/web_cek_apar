<?php
namespace App\Filament\Resources\AparResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class CekAparsRelationManager extends RelationManager
{
    protected static string $relationship = 'cek_apars';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tgl')
                    ->required(),
                Forms\Components\Toggle::make('jarum_tekanan'),
                Forms\Components\Toggle::make('segel'),
                Forms\Components\Toggle::make('handgrip'),
                Forms\Components\Toggle::make('tabung'),
                Forms\Components\Toggle::make('selang'),
                Forms\Components\Toggle::make('nozzle'),
                Forms\Components\Toggle::make('karung_gone'),
                Forms\Components\Toggle::make('air_drum'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('kode_apar')
            ->columns([
                Tables\Columns\TextColumn::make('kode_apar'),
                Tables\Columns\TextColumn::make('tgl'),
                Tables\Columns\BooleanColumn::make('jarum_tekanan'),
                Tables\Columns\BooleanColumn::make('segel'),
                Tables\Columns\BooleanColumn::make('handgrip'),
                Tables\Columns\BooleanColumn::make('tabung'),
                Tables\Columns\BooleanColumn::make('selang'),
                Tables\Columns\BooleanColumn::make('nozzle'),
                Tables\Columns\BooleanColumn::make('karung_gone'),
                Tables\Columns\BooleanColumn::make('air_drum'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
