<?php

namespace App\Filament\Resources\RumahAparResource\Pages;

use App\Filament\Resources\RumahAparResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRumahApar extends EditRecord
{
    protected static string $resource = RumahAparResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
