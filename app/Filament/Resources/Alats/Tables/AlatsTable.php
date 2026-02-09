<?php

namespace App\Filament\Resources\Alats\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AlatsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                ->disk('public')
                ->imageSize(50),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('code')
                    ->label('Code')
                    ->searchable(),
                TextColumn::make('total_qty')
                    ->label('Total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('good_qty')
                    ->label('Bagus')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('damaged_qty')
                    ->label('Rusak')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('borrowed_qty')
                    ->label('Dipinjam')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('lost_qty')
                    ->label('Hilang')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('available_qty')
                    ->label('Tersedia')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_available')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
