<x-filament::page>
    <div class="p-6 bg-white shadow rounded-lg">
        <h2 class="text-xl font-bold mb-4">Summary Pengecekan APAR</h2>
        <table class="w-full border-collapse border border-gray-500" style="font-size: 10px;">
            <thead>
                <tr class="border bg-gray-200">
                    <th class="border border-black p-2" rowspan="2">Department</th>
                    <th class="border border-black p-2" colspan="2">Kondisi APAR</th>
                    <th class="border border-black p-2" rowspan="2">Total</th>
                    <th class="border border-black p-2" rowspan="2">Keterangan</th>
                </tr>
                <tr class="border bg-gray-200">
                    <th class="border border-black p-2">OK</th>
                    <th class="border border-black p-2">NG</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($apars as $item)
                    <tr>
                        <td class="border border-gray-300">{{ $item->dept }}</td>
                        <td class="border border-gray-300">{{ $item->cek_apars->where('result', 'OK')->count() }}</td>
                        <td class="border border-gray-300">{{ $item->cek_apars->where('result', 'Not OK')->count() }}
                        </td>
                        <td class="border border-gray-300">{{ $item->cek_apars->count() }}</td>
                        <td class="border border-gray-300"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="p-6 bg-white shadow rounded-lg">
        <h2 class="text-xl font-bold mb-4">Summary Jadwal Refill APAR Per Bulan</h2>
        <table class="w-full border-collapse border border-gray-500 text-xs">
            <thead>
                <tr class="bg-gray-200">
                    <th>Bulan</th>
                    @foreach ($years as $year)
                        <th>{{ $year }}</th>
                    @endforeach
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($scheduleData as $row)
                    <tr>
                        <td class="border border-gray-300">{{ $row['month'] }}</td>
                        @foreach ($years as $year)
                            <td class="border border-gray-300">{{ $row[$year] }}</td>
                        @endforeach
                        <td class="border border-gray-300"></td>
                    </tr>
                @endforeach
                <tr class="bg-blue-200">
                    <td class="border border-black"><strong>Total</strong></td>
                    @foreach ($years as $year)
                        <td class="border border-black"><strong>{{ $totals[$year] ?? '-' }}</strong></td>
                    @endforeach
                    <td class="border border-black"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="p-6 bg-white shadow rounded-lg mt-6">
        <h2 class="text-xl font-bold mb-4">Summary Jadwal Refill APAR Per Divisi</h2>
        <table class="w-full border-collapse border border-gray-500 text-xs">
            <thead>
                <tr class="bg-gray-200">
                    <th>Department / Lokasi</th>
                    @foreach ($years as $year)
                        <th>{{ $year }}</th>
                    @endforeach
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departmentData as $row)
                    <tr>
                        <td class="border border-gray-300">{{ $row['dept'] }}</td>
                        @foreach ($years as $year)
                            <td class="border border-gray-300">{{ $row[$year] }}</td>
                        @endforeach
                        <td class="border border-gray-300"></td>
                    </tr>
                @endforeach
                <tr class="bg-blue-200">
                    <td class="border border-black"><strong>Total</strong></td>
                    @foreach ($years as $year)
                        <td class="border border-black"><strong>{{ $deptTotals[$year] ?? '-' }}</strong></td>
                    @endforeach
                    <td class="border border-black"></td>
                </tr>
            </tbody>
        </table>
    </div>



    <div class="p-6 bg-white shadow rounded-lg mt-6">
        <h2 class="text-xl font-bold mb-4">Summary Ukuran APAR</h2>
        <table class="w-full border-collapse border border-gray-500 text-xs">
            <thead>
                <tr class="bg-gray-200">
                    <th>Department / Lokasi</th>
                    @foreach ($sizes as $size)
                        <th>{{ $size }}</th>
                    @endforeach
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sizeData as $row)
                    <tr>
                        <td class="border border-gray-300">{{ $row['dept'] }}</td>
                        @foreach ($sizes as $size)
                            <td class="border border-gray-300">{{ $row[$size] }}</td>
                        @endforeach
                        <td class="border border-gray-300"></td>
                    </tr>
                @endforeach
                <tr class="bg-blue-200">
                    <td class="border border-black"><strong>Total</strong></td>
                    @foreach ($sizes as $size)
                        <td class="border border-black"><strong>{{ $sizeTotals[$size] ?? '-' }}</strong></td>
                    @endforeach
                    <td class="border border-black"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="p-6 bg-white shadow rounded-lg mt-6">
        <h2 class="text-xl font-bold mb-4">Summary Jenis APAR</h2>
        <table class="w-full border-collapse border border-gray-500 text-xs">
            <thead>
                <tr class="bg-gray-200">
                    <th>Department / Lokasi</th>
                    @foreach ($types as $type)
                        <th>{{ $type }}</th>
                    @endforeach
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($typeData as $row)
                    <tr>
                        <td class="border border-gray-300">{{ $row['dept'] }}</td>
                        @foreach ($types as $type)
                            <td class="border border-gray-300">{{ $row[$type] }}</td>
                        @endforeach
                        <td class="border border-gray-300"></td>
                    </tr>
                @endforeach
                <tr class="bg-blue-200">
                    <td class="border border-black"><strong>Total</strong></td>
                    @foreach ($types as $type)
                        <td class="border border-black"><strong>{{ $typeTotals[$type] ?? '-' }}</strong></td>
                    @endforeach
                    <td class="border border-black"></td>
                </tr>
            </tbody>
        </table>
    </div>

</x-filament::page>
