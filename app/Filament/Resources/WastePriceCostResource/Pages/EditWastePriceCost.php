<?php

namespace App\Filament\Resources\WastePriceCostResource\Pages;

use App\Filament\Resources\WastePriceCostResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Validator;

class EditWastePriceCost extends EditRecord
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

        return $data;
    }
}

