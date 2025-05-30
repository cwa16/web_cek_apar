<?php
namespace App\Http\Controllers;

use App\Models\Apar;
use App\Models\CekApar;
use App\Models\CekRumahApar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getApar(Request $request)
    {
        $kodeApar = $request->query('kode_apar');

        $aparData = Apar::where('kode_apar', $kodeApar)->first();

        return response()->json($aparData);
    }

    public function saveChecklist(Request $request)
    {
        $data = $request->all();

        $tgl = Carbon::parse($data['created_at'])->format('Y-m-d');

        // Initialize file paths
        $imagePaths = [];

        // Process each checklist image field
        $fields = ['pressure_gauge', 'seal', 'handgrip', 'tabung', 'selang', 'nozzle'];

        foreach ($fields as $field) {
            if ($request->hasFile("{$field}_image")) {
                $file                         = $request->file("{$field}_image");
                $filename                     = time() . "_{$field}." . $file->getClientOriginalExtension();
                $path                         = $file->storeAs('public/checklist_apar', $filename);
                $imagePaths["{$field}_image"] = str_replace('public/', 'storage/public/', $path); // Adjust path for access
            } else {
                $imagePaths["{$field}_image"] = null;
            }
        }

        \Log::info($imagePaths);

        // Check if any of the fields is 0 (Not OK)
        $isNotOk = collect($fields)->contains(fn($field) => $data[$field] == 0);

        // Determine the result field
        $result = $isNotOk ? 'Not OK' : 'OK';

        // Save checklist data
        $checklist = CekApar::updateOrCreate(
            [
                'kode_apar' => $data['kode_apar'],
                'tgl'       => $tgl,
            ],
            array_merge([
                'jarum_tekanan' => $data['pressure_gauge'],
                'segel'         => $data['seal'],
                'handgrip'      => $data['handgrip'],
                'tabung'        => $data['tabung'],
                'selang'        => $data['selang'],
                'nozzle'        => $data['nozzle'],
                'catatan'        => $data['catatan'],
                'result' => $result,
            ], $imagePaths)
        );

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan',
            'data'    => $checklist,
        ], 200);
    }

    public function saveChecklistRumah(Request $request)
    {
        $data = $request->all();

        $tgl = Carbon::parse($data['created_at'])->format('Y-m-d');

        // Initialize file paths
        $imagePaths = [];

        // Process each checklist image field
        $fields = ['drum', 'gone', 'kerusakan_box', 'kebersihan_box', 'gembok', 'kebersihan_drum'];

        foreach ($fields as $field) {
            if ($request->hasFile("{$field}_image")) {
                $file                         = $request->file("{$field}_image");
                $filename                     = time() . "_{$field}." . $file->getClientOriginalExtension();
                $path                         = $file->storeAs('public/checklist_apar', $filename);
                $imagePaths["{$field}_image"] = str_replace('public/', 'storage/public/', $path); // Adjust path for access
            } else {
                $imagePaths["{$field}_image"] = null;
            }
        }

        \Log::info($imagePaths);

        // Check if any of the fields is 0 (Not OK)
        $isNotOk = collect($fields)->contains(fn($field) => $data[$field] == 0);

        // Determine the result field
        $result = $isNotOk ? 'Not OK' : 'OK';

        // Save checklist data
        $checklist = CekRumahApar::updateOrCreate(
            [
                'rumah_apar_id' => $data['rumah_apar_id'],
                'tgl'       => $tgl,
            ],
            array_merge([
                'drum'              => $data['drum'],
                'gone'              => $data['gone'],
                'kerusakan_box'     => $data['kerusakan_box'],
                'kebersihan_box'    => $data['kebersihan_box'],
                'gembok'            => $data['gembok'],
                'kebersihan_drum'   => $data['kebersihan_drum'],
                'judge'             => $data['judge'],
            ], $imagePaths)
        );

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan',
            'data'    => $checklist,
        ], 200);
    }
}
