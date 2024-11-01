<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\WasteCategory; // Pastikan ini tidak dikomentari dan jalur benar
use Illuminate\Support\Facades\Log;

class WasteCategoriesTableSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel waste_categories.
     */
    public function run(): void
    {
        $filePath = database_path('data/waste_categories.csv');

        // Pastikan file ada
        if (!file_exists($filePath)) {
            Log::error("File tidak ditemukan: {$filePath}");
            return;
        }

        try {
            Excel::import(new class implements ToModel, WithHeadingRow {
                public function model(array $row)
                {
                    return new WasteCategory([
                        'parent_id' => $row['parent_id'] ?? null, // Gunakan null jika tidak ada
                        'name' => $row['name'],
                        'image' => $row['image'] ?? null, // Gunakan null jika tidak ada
                        'description' => $row['description'] ?? '', // Default ke string kosong
                        'recyclable' => $row['recyclable'] ?? false, // Default ke false
                        'hazardous' => $row['hazardous'] ?? false, // Default ke false
                        'disposal_method' => $row['disposal_method'] ?? '', // Default ke string kosong
                        'environmental_impact' => $row['environmental_impact'] ?? '' // Default ke string kosong
                    ]);
                }
            }, $filePath);

            Log::info('Data waste_categories berhasil diimpor dari ' . $filePath);
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
}
