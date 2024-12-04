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
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Radio;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Actions\RestoreAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;

class ArchivistResource extends Resource
{
    protected static ?string $model = Archivist::class;
    protected static ?string $navigationGroup = 'Administración de Archivos';
    protected static ?string $navigationLabel = 'Archivero';
    protected static ?string $navigationIcon = 'heroicon-m-folder';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'Archivero';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')
                    ->required()
                    ->label('Nombre'),
                Radio::make('tipo')
                    ->options([
                        'carpeta' => 'Carpeta',
                        'archivo' => 'Archivo',
                    ])
                    ->required()
                    ->label('Tipo'),
                Select::make('parent_id')
                    ->label('Carpeta')
                    ->options(Archivist::where('tipo', 'carpeta')->pluck('nombre', 'id'))
                    ->nullable(),
                FileUpload::make('archivo')
                    ->label('Archivo')
                    ->directory('archiveros') // Carpeta dentro de storage/app/public
                    ->visibility('public') // Asegura que sea accesible públicamente
                    ->nullable()
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']),
                DateTimePicker::make('fecha del archivo')
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')->label('Nombre')
                    ->searchable(),
                TextColumn::make('tipo')->label('Tipo')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('parent.nombre')->label('Carpeta')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('archivo')
                    ->label('Archivo')
                    ->formatStateUsing(function ($state) {
                        return $state
                            ? '<a href="' . Storage::url($state) . '" target="_blank" class="text-blue-500 underline">Ver archivo</a>'
                            : '<span class="text-gray-500">N/A</span>';
                    })
                    ->html()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('fecha del archivo')->label('Fecha del Archivo')
                    ->dateTime()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('created_at')->label('Creado desde')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->label('Actualizado desde')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(), // Agregar filtro para elementos eliminados
            ])
            ->actions([
                EditAction::make(), // Acción para editar
                RestoreAction::make(), // Agregar acción de restauración
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
    public static function getBreadcrumbForCreate(): string
    {
        return 'Crear Archivero';
    }
    public static function getBreadcrumbForEdit(): string
    {
        return 'Editar Archivero';
    }
}
