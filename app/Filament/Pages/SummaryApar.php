<?php
namespace App\Filament\Pages;

use App\Exports\SummaryAparExport;
use App\Models\Apar;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Maatwebsite\Excel\Facades\Excel;

class SummaryApar extends Page
{
    protected static ?string $navigationLabel = 'Summary APAR';
    protected static ?string $navigationGroup = 'Monitoring';
    protected static ?int $navigationSort     = 3;

    protected static string $view = 'filament.pages.summary-apar';

    public function getHeaderActions(): array
    {
        return [
            Action::make('Export to Excel')
                ->icon('heroicon-m-arrow-down-tray') // Use a valid Heroicon
                ->color('success')
                ->action(fn() => Excel::download(new SummaryAparExport, 'summary-apar.xlsx')),
        ];
    }

    protected function getViewData(): array
    {
        // Get all unique years for refill schedule (with next_refill - 1 month)
        $years = Apar::selectRaw("YEAR(DATE_SUB(next_refill, INTERVAL 1 MONTH)) as year")
            ->distinct()
            ->orderBy('year')
            ->pluck('year')
            ->toArray();

        // Get unique APAR sizes
        $sizes = Apar::distinct()->pluck('berat')->sort()->toArray();

        // Get refill schedule grouped by adjusted month and year
        $jadwal = Apar::selectRaw("YEAR(DATE_SUB(next_refill, INTERVAL 1 MONTH)) as year, MONTH(DATE_SUB(next_refill, INTERVAL 1 MONTH)) as month, COUNT(*) as count")
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Get refill schedule grouped by department and adjusted year
        $jadwalPerDept = Apar::selectRaw("dept, YEAR(DATE_SUB(next_refill, INTERVAL 1 MONTH)) as year, COUNT(*) as count")
            ->groupBy('dept', 'year')
            ->orderBy('dept')
            ->orderBy('year')
            ->get();

        // Get refill schedule grouped by original month and year (no date sub)
        $expired = Apar::selectRaw("YEAR(next_refill) as year, MONTH(next_refill) as month, COUNT(*) as count")
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

// Get refill schedule grouped by department and original year (no date sub)
        $expiredPerDept = Apar::selectRaw("dept, YEAR(next_refill) as year, COUNT(*) as count")
            ->groupBy('dept', 'year')
            ->orderBy('dept')
            ->orderBy('year')
            ->get();

        // Get APAR sizes grouped by department
        $sizePerDept = Apar::selectRaw("dept, berat, COUNT(*) as count")
            ->groupBy('dept', 'berat')
            ->orderBy('dept')
            ->orderBy('berat')
            ->get();

        // Get APAR types grouped by department
        $typePerDept = Apar::selectRaw("dept, type, COUNT(*) as count")
            ->groupBy('dept', 'type')
            ->orderBy('dept')
            ->orderBy('type')
            ->get();

        // Format department-based data
        $departments = Apar::distinct()->pluck('dept')->toArray();
        // Get unique APAR types
        $types             = Apar::distinct()->pluck('type')->sort()->toArray();
        $formattedDeptData = [];
        $deptTotals        = array_fill_keys($years, 0);

        foreach ($departments as $dept) {
            $row = ['dept' => $dept];

            foreach ($years as $year) {
                $count      = $jadwalPerDept->where('dept', $dept)->where('year', $year)->first()->count ?? 0;
                $row[$year] = $count ?: '-';
                $deptTotals[$year] += $count;
            }

            $formattedDeptData[] = $row;
        }

        // Ensure months 1-12 are present
        $months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4  => 'Apr', 5  => 'Mei', 6  => 'Jun',
            7 => 'Jul', 8 => 'Ags', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des',
        ];

        $formattedMonthData = [];
        $monthTotals        = array_fill_keys($years, 0);

        foreach ($months as $num => $name) {
            $row = ['month' => $name];

            foreach ($years as $year) {
                $count      = $jadwal->where('year', $year)->where('month', $num)->first()->count ?? 0;
                $row[$year] = $count ?: '-';
                $monthTotals[$year] += $count;
            }

            $formattedMonthData[] = $row;
        }

        // Format APAR size data
        $formattedSizeData = [];
        $sizeTotals        = array_fill_keys($sizes, 0);

        foreach ($departments as $dept) {
            $row = ['dept' => $dept];

            foreach ($sizes as $size) {
                $count      = $sizePerDept->where('dept', $dept)->where('berat', $size)->first()->count ?? 0;
                $row[$size] = $count ?: '-';
                $sizeTotals[$size] += $count;
            }

            $formattedSizeData[] = $row;
        }

        // Format department-based data for types
        $formattedTypeData = [];
        $typeTotals        = array_fill_keys($types, 0);

        foreach ($departments as $dept) {
            $row = ['dept' => $dept];

            foreach ($types as $type) {
                $count      = $typePerDept->where('dept', $dept)->where('type', $type)->first()->count ?? 0;
                $row[$type] = $count ?: '-';
                $typeTotals[$type] += $count;
            }

            $formattedTypeData[] = $row;
        }

        return [
            'apars'          => Apar::with('cek_apars')->groupBy('dept')->get(),
            'years'          => $years,
            'sizes'          => $sizes,
            'scheduleData'   => $formattedMonthData,
            'totals'         => $monthTotals,
            'departmentData' => $formattedDeptData,
            'deptTotals'     => $deptTotals,
            'sizeData'       => $formattedSizeData,
            'sizeTotals'     => $sizeTotals,
            'types'          => $types,
            'typeData'       => $formattedTypeData,
            'typeTotals'     => $typeTotals,
            'expired'        => $expired,
            'expiredPerDept' => $expiredPerDept,
        ];
    }
}
