<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\WastePriceCost;
use Illuminate\Support\Facades\Log;

class WastePriceCostTableSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel waste_price_costs.
     */
    public function run(): void
    {
        $filePath = database_path('data/waste_price_costs.csv');

        // Pastikan file ada
        if (!file_exists($filePath)) {
            Log::error("File tidak ditemukan: {$filePath}");
            return;
        }

        try {
            Excel::import(new class implements ToModel, WithHeadingRow {
                public function model(array $row)
                {
                    return new WastePriceCost([
                        'waste_id' => $row['waste_id'], // Pastikan 'waste_id' ada
                        'is_valuable' => $row['is_valuable'] ?? false, // Default ke false jika tidak ada
                        'amount' => $row['amount'],
                        'unit' => $row['unit'] ?? '', // Default ke string kosong jika tidak ada
                        'price_cost' => $row['price_cost'] ?? 0, // Default ke 0 jika tidak ada
                    ]);
                }
            }, $filePath);

            Log::info('Data waste_price_costs berhasil diimpor dari ' . $filePath);
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
}
