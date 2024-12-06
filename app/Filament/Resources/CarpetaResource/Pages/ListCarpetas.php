<?php

namespace App\Filament\Resources\CarpetaResource\Pages;

use App\Filament\Resources\CarpetaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCarpetas extends ListRecords
{
    protected static string $resource = CarpetaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
