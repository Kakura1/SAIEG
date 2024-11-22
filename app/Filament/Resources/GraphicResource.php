<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GraphicResource\Pages;
use App\Filament\Resources\GraphicResource\RelationManagers;
use App\Models\Graphic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GraphicResource extends Resource
{
    protected static ?string $model = Graphic::class;
    protected static ?string $navigationGroup = 'Administración de Archivos';
    protected static ?string $navigationLabel = 'Gráficas';
    protected static ?string $navigationIcon = 'heroicon-c-arrow-trending-up';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGraphics::route('/'),
            'create' => Pages\CreateGraphic::route('/create'),
            'edit' => Pages\EditGraphic::route('/{record}/edit'),
        ];
    }
}
