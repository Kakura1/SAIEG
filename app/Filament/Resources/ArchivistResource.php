<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArchivistResource\Pages;
use App\Filament\Resources\ArchivistResource\RelationManagers;
use App\Models\Archivist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArchivistResource extends Resource
{
    protected static ?string $model = Archivist::class;
    protected static ?string $navigationGroup = 'Administración de Archivos';
    protected static ?string $navigationLabel = 'Archivero';
    protected static ?string $navigationIcon = 'heroicon-m-folder';
    protected static ?int $navigationSort = 3;

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
            'index' => Pages\ListArchivists::route('/'),
            'create' => Pages\CreateArchivist::route('/create'),
            'edit' => Pages\EditArchivist::route('/{record}/edit'),
        ];
    }
}
