<?php

namespace App\Filament\Resources\AparResource\Pages;

use App\Filament\Resources\AparResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApars extends ListRecords
{
    protected static string $resource = AparResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
