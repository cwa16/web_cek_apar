<?php
namespace App\Exports;

use App\Models\Apar;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SummaryAparExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        // Get all unique years for refill schedule
        $years = Apar::selectRaw("YEAR(next_refill) as year")
            ->distinct()
            ->orderBy('year')
            ->pluck('year')
            ->toArray();

        // Get unique APAR sizes
        $sizes = Apar::distinct()->pluck('berat')->sort()->toArray();

        // Get refill schedule grouped by month and year
        $jadwal = Apar::selectRaw("YEAR(next_refill) as year, MONTH(next_refill) as month, COUNT(*) as count")
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Get refill schedule grouped by department
        $jadwalPerDept = Apar::selectRaw("dept, YEAR(next_refill) as year, COUNT(*) as count")
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

        return view('exports.summary-apar', [
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
        ]);
    }
}
