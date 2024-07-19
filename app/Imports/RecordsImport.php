<?php

namespace App\Imports;

use App\Models\Record;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

class RecordsImport {
    public function import($filePath) {
        try {
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();

            foreach (array_slice($data, 1) as $row) {
                $validator = Validator::make([
                    'name' => $row[0],
                    'class' => $row[1],
                    'level' => $row[2],
                    'parentContact' => $row[3],
                ], [
                    'name' => 'required|string',
                    'class' => 'required|string',
                    'level' => 'required|integer',
                    'parentContact' => 'required|string|size:10',
                ]);

                if ($validator->fails()) {
                    Log::error('Validation failed for row: ' . json_encode($row));
                    continue;
                }

                Record::create([
                    'name' => $row[0],
                    'class' => $row[1],
                    'level' => $row[2],
                    'parentContact' => $row[3],
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error importing file: ' . $e->getMessage());
        }
    }
}

