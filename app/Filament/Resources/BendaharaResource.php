<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BendaharaResource\Pages;
use App\Models\Bendahara;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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

                Forms\Components\Section::make('Input Kas Siswa')
                    ->description('Pilih siswa dan masukkan jumlah kas yang dibayar.')
                    ->schema([
                        Forms\Components\Select::make('siswa_id')
                            ->label('Pilih Siswa (berdasarkan NISN)')
                            ->options(Siswa::all()->pluck('label', 'id')) // label = accessor di model
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $siswa = Siswa::find($state);
                                if ($siswa) {
                                    $set('nama_siswa', $siswa->nama); // gunakan 'nama' bukan 'nama_siswa'
                                }
                            }),

                        Forms\Components\TextInput::make('nama_siswa')
                            ->label('Nama Siswa')
                            ->disabled()
                            ->dehydrated(false)
                            ->default(function (callable $get) {
                                $siswa = Siswa::find($get('siswa_id'));
                                return $siswa?->nama ?? '';
                            }),

                        Forms\Components\TextInput::make('jumlah')
                            ->label('Jumlah Kas Dibayar')
                            ->numeric()
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_bendahara')->label('Nama'),
                Tables\Columns\TextColumn::make('kelas')->label('Kelas'),
                Tables\Columns\TextColumn::make('siswa.nama')->label('Nama Siswa'),
                Tables\Columns\TextColumn::make('jumlah')->label('Jumlah'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y H:i'),
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
        return [];
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
