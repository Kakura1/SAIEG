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
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Gate;

class ArchivistResource extends Resource
{
    protected static ?string $model = Archivist::class;
    protected static ?string $navigationGroup = 'Administración de Archivos';
    protected static ?string $navigationLabel = 'Estadística';
    protected static ?string $navigationIcon = 'heroicon-m-folder';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'Archivo';

    public static function authorizeResourceAccess(string $action): bool
    {
        $user = auth()->user();

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
        return $form
            ->schema([
                TextInput::make('nombre')
                    ->required()
                    ->label('Nombre'),
                Select::make('carpeta_id')
                    ->label('Carpeta')
                    ->relationship('carpeta', 'nombre')
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
                    ->placeholder('Selecciona o crea una carpeta'),
                FileUpload::make('archivo')
                    ->label('Archivo')
                    ->directory('archiveros') // Carpeta dentro de storage/app/public
                    ->visibility('public') // Asegura que sea accesible públicamente
                    ->nullable()
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']),
                DatePicker::make('fecha')
                    ->label('Fecha del archivo')
                    ->required() // Si deseas que sea obligatorio
                    ->placeholder('Selecciona una fecha')
                    ->displayFormat('Y-m-d') // Muestra año-mes-día
                    ->closeOnDateSelection(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')->label('Nombre')
                    ->searchable()->sortable(),
                TextColumn::make('carpeta.nombre')
                    ->label('Carpeta')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('archivo')
                    ->label('Archivo')
                    ->formatStateUsing(function ($state) {
                        return $state
                            ? '<a href="' . Storage::url($state) . '" target="_blank" class="text-blue-500 underline">Ver archivo</a>'
                            : '<span class="text-gray-500">N/A</span>';
                    })
                    ->html()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('fecha')
                    ->searchable()->sortable()
                    ->label('Fecha del Archivo')
                    ->date('Y-m-d'), // Muestra año-mes-día,
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
                Tables\Actions\ViewAction::make()
                ->visible(fn () => auth()->user()?->hasRole('administrador')),
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
            'view' => Pages\ViewArchivist::route('/{record}'),
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
