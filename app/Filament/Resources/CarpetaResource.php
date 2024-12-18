<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarpetaResource\Pages;
use App\Filament\Resources\CarpetaResource\RelationManagers;
use App\Models\Carpeta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Gate;

class CarpetaResource extends Resource
{
    protected static ?string $model = Carpeta::class;
    protected static ?string $navigationGroup = 'Administración de Archivos';
    protected static ?string $navigationLabel = 'Temas';
    protected static ?int $navigationSort = 7;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';



    public static function authorizeResourceAccess(string $action): bool
    {
        $user = Filament::auth()->user();

        return match ($action) {
            'viewAny', 'view' => Gate::allows('ver'),
            'create' => Gate::allows('crear'),
            'update' => Gate::allows('editar'),
            'delete' => Gate::allows('eliminar'),
            default => false,
        };
    }


    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nombre')
                ->label('Nombre')
                ->required()
                ->maxLength(255),

            Textarea::make('descripcion')
                ->label('Descripción')
                ->nullable(),

            Select::make('parent_id')
                ->label('Carpeta Padre')
                ->relationship('parent', 'nombre') // Relación con la carpeta padre
                ->createOptionForm([
                    TextInput::make('nombre')
                        ->label('Nombre')
                        ->required()
                        ->maxLength(255),

                    Textarea::make('descripcion')
                        ->label('Descripción')
                        ->nullable(),
                ])
                ->searchable()
                ->preload()
                ->live()
                ->nullable()
                ->placeholder('Selecciona o crea una carpeta padre'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable() // Permite buscar por este campo
                    ->sortable(), // Permite ordenar por este campo

                TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->limit(50) // Limita la longitud del texto en la tabla
                    ->wrap(),

                TextColumn::make('parent.nombre')
                    ->label('Carpeta')
                    ->toggleable() // Hace la columna opcional para mostrar u ocultar
                    ->sortable() // Permite ordenar por la carpeta padre
                    ->searchable() // Permite buscar por la carpeta padre
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->date('Y-m-d') // Muestra solo la fecha
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Columna oculta por defecto

                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->date('Y-m-d')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Columna oculta por defecto
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCarpetas::route('/'),
            'create' => Pages\CreateCarpeta::route('/create'),
            'view' => Pages\ViewCarpeta::route('/{record}'),
            'edit' => Pages\EditCarpeta::route('/{record}/edit'),
        ];
    }
}
