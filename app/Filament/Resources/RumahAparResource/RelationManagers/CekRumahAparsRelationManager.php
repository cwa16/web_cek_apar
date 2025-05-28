<?php

namespace App\Filament\Resources\RumahAparResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CekRumahAparsRelationManager extends RelationManager
{
    protected static string $relationship = 'cekRumahApars';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                   Forms\Components\DatePicker::make('tgl')->required(),
                    Forms\Components\Toggle::make('drum'),
                    Forms\Components\Toggle::make('gone'),
                    Forms\Components\Toggle::make('kerusakan_box'),
                    Forms\Components\Toggle::make('kebersihan_box'),
                    Forms\Components\Toggle::make('gembok'),
                    Forms\Components\Toggle::make('kebersihan_drum'),
                    Forms\Components\Select::make('judge')
                        ->options([
                            'OK' => 'OK',
                            'Not OK' => 'Not OK',
                        ])
                        ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
        ->recordTitleAttribute('rumah_apar_id')
            ->columns([
                Tables\Columns\TextColumn::make('tgl')->date(),
                Tables\Columns\IconColumn::make('drum')->boolean(),
                Tables\Columns\IconColumn::make('gone')->boolean(),
                Tables\Columns\IconColumn::make('kerusakan_box')->boolean(),
                Tables\Columns\IconColumn::make('kebersihan_box')->boolean(),
                Tables\Columns\IconColumn::make('gembok')->boolean(),
                Tables\Columns\IconColumn::make('kebersihan_drum')->boolean(),
                Tables\Columns\TextColumn::make('judge'),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
