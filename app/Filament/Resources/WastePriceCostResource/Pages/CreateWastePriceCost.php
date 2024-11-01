<?php

namespace App\Filament\Resources\WastePriceCostResource\Pages;

use App\Filament\Resources\WastePriceCostResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Validator;
use App\Models\WastePriceCost;

class CreateWastePriceCost extends CreateRecord
{
    protected static string $resource = WastePriceCostResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Validasi data
        Validator::make($data, [
            'waste_id' => 'required|exists:waste_categories,id',
            'amount' => 'required|numeric',
            'unit' => 'required|string',
            'price_cost' => 'required|numeric',
        ])->validate();

        // Simpan data ke database
        try {
            WastePriceCost::create([
                'waste_id' => $data['waste_id'],
                'amount' => $data['amount'], // Pastikan ini disertakan
                'unit' => $data['unit'],
                'price_cost' => $data['price_cost'],
            ]);
        } catch (\Exception $e) {
            // Tangani error, bisa dengan logging atau menampilkan pesan
            // echo $e->getMessage(); // Untuk debugging (hilangkan di produksi)
            // Anda bisa menggunakan flash message atau redirect jika ada error
            // return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            throw $e; // Meneruskan exception untuk melihat pesan error asli
        }

        return $data;
    }
}
