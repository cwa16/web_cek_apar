<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <h2>Summary Pengecekan APAR</h2>
    <table style="font-size: 10px;">
        <thead>
            <tr>
                <th rowspan="2">Department</th>
                <th colspan="2">Kondisi APAR</th>
                <th rowspan="2">Total</th>
                <th rowspan="2">Keterangan</th>
            </tr>
            <tr>
                <th>OK</th>
                <th>NG</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($apars as $item)
                <tr>
                    <td>{{ $item->dept }}</td>
                    <td>{{ $item->cek_apars->where('result', 'OK')->count() }}</td>
                    <td>{{ $item->cek_apars->where('result', 'Not OK')->count() }}
                    </td>
                    <td>{{ $item->cek_apars->count() }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Summary Jadwal Refill APAR Per Bulan</h2>
    <table>
        <thead>
            <tr>
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
                    <td>{{ $row['month'] }}</td>
                    @foreach ($years as $year)
                        <td>{{ $row[$year] }}</td>
                    @endforeach
                    <td></td>
                </tr>
            @endforeach
            <tr>
                <td><strong>Total</strong></td>
                @foreach ($years as $year)
                    <td><strong>{{ $totals[$year] ?? '-' }}</strong></td>
                @endforeach
                <td></td>
            </tr>
        </tbody>
    </table>

    <h2>Summary Jadwal Refill APAR Per Divisi</h2>
    <table>
        <thead>
            <tr>
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
                    <td>{{ $row['dept'] }}</td>
                    @foreach ($years as $year)
                        <td>{{ $row[$year] }}</td>
                    @endforeach
                    <td></td>
                </tr>
            @endforeach
            <tr>
                <td><strong>Total</strong></td>
                @foreach ($years as $year)
                    <td><strong>{{ $deptTotals[$year] ?? '-' }}</strong></td>
                @endforeach
                <td></td>
            </tr>
        </tbody>
    </table>

    <h3>Summary Ukuran APAR</h3>
    <table border="1">
        <thead>
            <tr>
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
                    <td>{{ $row['dept'] }}</td>
                    @foreach ($sizes as $size)
                        <td>{{ $row[$size] }}</td>
                    @endforeach
                    <td></td>
                </tr>
            @endforeach
            <tr>
                <td><strong>Total</strong></td>
                @foreach ($sizes as $size)
                    <td><strong>{{ $sizeTotals[$size] ?? '-' }}</strong></td>
                @endforeach
                <td></td>
            </tr>
        </tbody>
    </table>

    <h3>Summary Jenis APAR</h3>
    <table border="1">
        <thead>
            <tr>
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
                    <td>{{ $row['dept'] }}</td>
                    @foreach ($types as $type)
                        <td>{{ $row[$type] }}</td>
                    @endforeach
                    <td></td>
                </tr>
            @endforeach
            <tr>
                <td><strong>Total</strong></td>
                @foreach ($types as $type)
                    <td><strong>{{ $typeTotals[$type] ?? '-' }}</strong></td>
                @endforeach
                <td></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
