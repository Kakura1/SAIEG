<?php

namespace App\Filament\Resources\ArchivistResource\Pages;

use App\Filament\Resources\ArchivistResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewArchivist extends ViewRecord
{
    protected static string $resource = ArchivistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
