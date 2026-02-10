<?php

namespace App\Filament\Resources\Alats\Tables;

use App\Models\Category;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class AlatsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ColumnGroup::make('Detail Alat', [
                    ImageColumn::make('image')
                        ->disk('public')
                        ->imageSize(50),
                    TextColumn::make('name')
                        ->label('Nama Alat')
                        ->searchable(),
                    TextColumn::make('code')
                        ->label('Code')
                        ->searchable(),
                    TextColumn::make('category.name')
                        ->label('Category')
                        ->toggleable(isToggledHiddenByDefault: true),
                ]),
                ColumnGroup::make('Kondisi Alat / Stock', [

                    TextColumn::make('good_qty')
                        ->label('Bagus')
                        ->numeric(),
                    TextColumn::make('damaged_qty')
                        ->label('Rusak')
                        ->numeric(),
                    TextColumn::make('borrowed_qty')
                        ->label('Dipinjam')
                        ->numeric(),
                    TextColumn::make('lost_qty')
                        ->label('Hilang')
                        ->numeric(),
                    TextColumn::make('total_qty')
                        ->label('Total')
                        ->numeric(),
                    TextColumn::make('available_qty')
                        ->label('Tersedia')
                        ->numeric()
                        ->getStateUsing(fn($record)=>$record->good_qty - $record->borrowed_qty)
                        ->badge(),
                ]),


                IconColumn::make('is_available')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()

                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()

                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),
                TernaryFilter::make('is_available')
                    ->label('Ketersediaan')

            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
