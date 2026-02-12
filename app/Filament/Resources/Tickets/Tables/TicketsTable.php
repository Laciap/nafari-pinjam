<?php

namespace App\Filament\Resources\Tickets\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ticket_number')
                    ->label('Ticket#')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Peminjam')
                    ->sortable(),
                TextColumn::make('alat.name')
                    ->label('Nama Alat')
                    ->sortable(),

                TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('booked_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('borrowed_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('due_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('returned_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge(),
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
                Action::make('approveBorrowing')
                ->label('Menyetujui Pinjaman')
                ->color('warning')
                ->requiresConfirmation()
                ->visible(fn($record) => $record->status === 'booked')
                ->action(fn($record) => $record->update([
                    'status' => 'borrowed',
                    'borrowed_at' => now(),    
                ]))->button(),
                Action::make('verifyReturn')
                ->label('Memverifikasi Pengembalian')
                ->color('warning')
                ->requiresConfirmation()
                ->visible(fn($record) => $record->status === 'borrowed')
                ->action(fn($record) => $record->update([
                    'status' => 'verifying',    
                ]))->button(),
                
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
                Action::make('Completed')
                ->label('Selesai')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn($record) => $record->status === 'verifying')
                ->action(fn($record) => $record->update([
                    'status' => 'returned',
                    'returned_at' => now(),    
                ]))->button(),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
