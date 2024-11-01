<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WasteCategoryResource\Pages;
use App\Models\WasteCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WasteCategoryResource extends Resource
{
    protected static ?string $model = WasteCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack'; // Bisa ubah icon jika perlu

    // Form untuk Create dan Edit
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\TextInput::make('image')
                    ->label('Gambar URL')
                    ->nullable()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('recyclable')
                    ->label('Dapat Didaur Ulang')
                    ->default(false),

                Forms\Components\Toggle::make('hazardous')
                    ->label('Bahan Berbahaya')
                    ->default(false),

                Forms\Components\TextInput::make('disposal_method')
                    ->label('Metode Pembuangan')
                    ->nullable()
                    ->maxLength(255),

                Forms\Components\TextInput::make('environmental_impact')
                    ->label('Dampak Lingkungan')
                    ->nullable()
                    ->maxLength(255),
            ]);
    }

    // Table untuk List Data
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BooleanColumn::make('recyclable')
                    ->label('Dapat Didaur Ulang'),

                Tables\Columns\BooleanColumn::make('hazardous')
                    ->label('Berbahaya'),

                Tables\Columns\TextColumn::make('disposal_method')
                    ->label('Metode Pembuangan'),

                Tables\Columns\TextColumn::make('environmental_impact')
                    ->label('Dampak Lingkungan'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([ // Tambahkan filter jika dibutuhkan
                //
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
        return [
            // Tambahkan relation manager jika ada
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWasteCategories::route('/'),
            'create' => Pages\CreateWasteCategory::route('/create'),
            'edit' => Pages\EditWasteCategory::route('/{record}/edit'),
        ];
    }
}
