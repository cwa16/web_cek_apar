<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\CekApar;

class LogApar extends Page
{
    protected static ?string $navigationLabel = 'Log APAR';
    protected static ?string $navigationGroup = 'Monitoring';
    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.pages.log-apar';

    protected function getViewData(): array
    {
        return [
            'cekApars' => CekApar::latest()->get(),
        ];
    }
}
