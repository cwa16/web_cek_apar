<?php

namespace App\Filament\Resources\RumahAparResource\Pages;

use App\Filament\Resources\RumahAparResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRumahApars extends ListRecords
{
    protected static string $resource = RumahAparResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
