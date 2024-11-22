<?php

namespace App\Filament\Resources\ArchivistResource\Pages;

use App\Filament\Resources\ArchivistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArchivist extends EditRecord
{
    protected static string $resource = ArchivistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
