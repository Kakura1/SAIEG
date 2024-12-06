<?php

namespace App\Filament\Resources\CarpetaResource\Pages;

use App\Filament\Resources\CarpetaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCarpeta extends ViewRecord
{
    protected static string $resource = CarpetaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
