<?php

namespace App\Filament\Resources\ArchivistResource\Pages;

use App\Filament\Resources\ArchivistResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArchivists extends ListRecords
{
    protected static string $resource = ArchivistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
