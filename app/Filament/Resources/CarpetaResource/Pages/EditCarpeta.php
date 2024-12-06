<?php

namespace App\Filament\Resources\CarpetaResource\Pages;

use App\Filament\Resources\CarpetaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCarpeta extends EditRecord
{
    protected static string $resource = CarpetaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
