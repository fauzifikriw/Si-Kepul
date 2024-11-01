<?php

namespace App\Filament\Resources\WastePriceCostResource\Pages;

use App\Filament\Resources\WastePriceCostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWastePriceCosts extends ListRecords
{
    protected static string $resource = WastePriceCostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
