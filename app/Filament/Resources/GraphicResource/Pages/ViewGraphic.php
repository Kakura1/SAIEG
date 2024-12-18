<?php

namespace App\Filament\Resources\GraphicResource\Pages;

use App\Filament\Resources\GraphicResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGraphic extends ViewRecord
{
    protected static string $resource = GraphicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
