<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WastePriceCostResource\Pages;
use App\Models\WastePriceCost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WastePriceCostResource extends Resource
{
    protected static ?string $model = WastePriceCost::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar'; // Icon yang lebih relevan

    // Form untuk Create dan Edit Data
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('waste_id')
                    ->label('Kategori Sampah')
                    ->relationship('waste', 'name')
                    ->required(),

                Forms\Components\TextInput::make('amount')
                    ->label('Jumlah')
                    ->numeric()
                    ->required(),

                Forms\Components\Select::make('unit')
                    ->label('Satuan')
                    ->options([
                        'kg' => 'Kilogram',
                        'liter' => 'Liter',
                        'pcs' => 'Pcs',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('price_cost')
                    ->label('Harga (Rp)') 
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('is_valuable')
                    ->label('Nilai') // Ganti label sesuai kebutuhan
                    ->numeric()
                    ->required(),

                Forms\Components\DateTimePicker::make('created_at')
                    ->label('Dibuat pada')
                    ->required()
                    ->disabled() // Nonaktifkan field created_at agar tidak dapat diedit
                    ->default(now()),

                // Menampilkan updated_at pada halaman edit
                Forms\Components\DateTimePicker::make('updated_at')
                    ->label('Diperbarui pada')
                    ->required()
                    ->disabled(false) // Memungkinkan field updated_at untuk diedit
                    ->hidden(fn ($record) => $record === null), // Sembunyikan pada create
            ]);
    }

    // Tabel untuk Menampilkan Data
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('waste.name')
                    ->label('Kategori Sampah')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Jumlah')
                    ->sortable(),

                Tables\Columns\TextColumn::make('unit')
                    ->label('Satuan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_cost')
                    ->label('Harga (Rp)')
                    ->money('IDR', true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('is_valuable')
                    ->label('Nilai')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat pada')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui pada')
                    ->dateTime()
                    ->sortable()
                    // ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('waste_id')
                    ->label('Kategori Sampah')
                    ->relationship('waste', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWastePriceCosts::route('/'),
            'create' => Pages\CreateWastePriceCost::route('/create'),
            'edit' => Pages\EditWastePriceCost::route('/{record}/edit'),
        ];
    }
}
