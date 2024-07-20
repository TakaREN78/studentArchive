<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use App\Imports\RecordsImport;
use Illuminate\Support\Facades\Log;

class RecordController extends Controller
{
    public function index(Request $request)
    {
        $query = Record::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('parentContact', 'like', "%$search%");
            });
        }

        if ($class = $request->input('class')) {
            $query->where('class', $class);
        }

        $records = $query->get();

        return view('records.index', compact('records'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'filename' => 'required|file|mimes:xls',
        ]);

        $file = $request->file('filename');
        $filePath = $file->getRealPath();

        Log::info('File upload initiated: ' . $filePath);

        try {
            $importer = new RecordsImport();
            $importer->import($filePath);
            Log::info('File upload completed');

            if (!empty($importer->duplicates)) {
                $duplicateNames = array_map(function ($record) {
                    return $record['name'];
                }, $importer->duplicates);

                $duplicateMessage = 'Duplicates found for names: ' . implode(', ', $duplicateNames);
                return redirect()->back()->with('success', 'File uploaded successfully')->with('duplicates', $duplicateMessage);
            }
        } catch (\Exception $e) {
            Log::error('File upload failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['filename' => 'File upload failed: ' . $e->getMessage()]);
        }

        return redirect()->back()->with('success', 'File uploaded successfully');
    }
}
