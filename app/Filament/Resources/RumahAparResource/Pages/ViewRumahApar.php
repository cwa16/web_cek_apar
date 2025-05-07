<?php

namespace App\Filament\Resources\RumahAparResource\Pages;

use App\Filament\Resources\RumahAparResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRumahApar extends ViewRecord
{
    protected static string $resource = RumahAparResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
