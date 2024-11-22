<?php

namespace App\Filament\Resources\GraphicResource\Pages;

use App\Filament\Resources\GraphicResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGraphic extends EditRecord
{
    protected static string $resource = GraphicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
