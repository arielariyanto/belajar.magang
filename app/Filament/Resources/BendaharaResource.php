<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BendaharaResource\Pages;
use App\Filament\Resources\BendaharaResource\RelationManagers;
use App\Models\Bendahara;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BendaharaResource extends Resource
{
    protected static ?string $model = Bendahara::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Data Bendahara';
    protected static ?string $pluralModelLabel = 'Bendahara';
    protected static ?string $navigationGroup = 'Manajemen Kas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_bendahara')
                    ->label('Nama Bendahara')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('kelas')
                ->label('Kelas')
                ->required()
                ->options([
                    'X' => 'X',
                    'XI' => 'XI',
                    'XII' => 'XII',
                ])
                ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_bendahara')->label('Nama'),
                Tables\Columns\TextColumn::make('kelas')->label('Kelas'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBendaharas::route('/'),
            'create' => Pages\CreateBendahara::route('/create'),
            'edit' => Pages\EditBendahara::route('/{record}/edit'),
        ];
    }
}
