<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AparResource\Pages;
use App\Filament\Resources\AparResource\RelationManagers;
use App\Models\Apar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AparResource extends Resource
{
    protected static ?string $model = Apar::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
//
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_apar')
                    ->required(),
                Forms\Components\TextInput::make('no_apar')
                    ->required(),
                Forms\Components\Select::make('dept')
                    ->options([
                        'ho' => 'HO',
                        'sub divisi a' => 'Sub Divisi A',
                        'sub divisi b' => 'Sub Divisi B',
                        'sub divisi c' => 'Sub Divisi C',
                        'sub divisi d' => 'Sub Divisi D',
                        'sub divisi e' => 'Sub Divisi E',
                        'sub divisi f' => 'Sub Divisi F',
                        'fsd' => 'FSD',
                        'workshop' => 'Workshop',
                        'factory' => 'Factory',
                        'store' => 'Store',
                        'lab' => 'Lab',
                    ]),
                Forms\Components\TextInput::make('lokasi'),
                Forms\Components\TextInput::make('latitude'),
                Forms\Components\TextInput::make('longitude'),
                Forms\Components\TextInput::make('berat'),
                Forms\Components\TextInput::make('merk'),
                Forms\Components\Select::make('type')
                    ->options([
                        'co' => 'CO',
                        'powder' => 'Powder',
                        'foam' => 'Foam',
                    ]),
                Forms\Components\Datepicker::make('tgl_pembelian'),
                Forms\Components\Datepicker::make('last_refill'),
                Forms\Components\Datepicker::make('next_refill'),
                Forms\Components\TextInput::make('standar_pengisian'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_apar')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('no_apar')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('dept')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('lokasi')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('latitude')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('longitude')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('berat')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('merk')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('type')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('tgl_pembelian')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('last_refill')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('next_refill')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('standar_pengisian')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('rumah_apar_id')->searchable()->sortable(),
            ])
            ->filters([
                //
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
            RelationManagers\CekAparsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApars::route('/'),
            'create' => Pages\CreateApar::route('/create'),
            'edit' => Pages\EditApar::route('/{record}/edit'),
        ];
    }
}
