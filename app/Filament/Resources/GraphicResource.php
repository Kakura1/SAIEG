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

class GraphicResource extends Resource
{
    protected static ?string $model = Graphic::class;
    protected static ?string $navigationGroup = 'Administración de Archivos';
    protected static ?string $navigationLabel = 'Graficos';
    protected static ?string $navigationIcon = 'heroicon-s-document-text';
    protected static ?int $navigationSort = 4;
    protected static ?string $modelLabel = 'Grafico';

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
                    ->label('Documento')
                    ->directory('Documentos') // Carpeta dentro de storage/app/public
                    ->visibility('public') // Asegura que sea accesible públicamente
                    ->nullable()
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']),
                DatePicker::make('Fecha del documento')
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
                    ->label('Fecha del Documento')
                    ->date('Y-m-d'), // Muestra año-mes-día,
                TextColumn::make('created_at')->label('Creado desde')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('updated_at')->label('Actualizado desde')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                EditAction::make(),
                RestoreAction::make(),
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
            'view' => Pages\ViewGraphic::route('/{record}'),
            'edit' => Pages\EditGraphic::route('/{record}/edit'),
        ];
    }
}
