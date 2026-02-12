<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Landing Transaction')
                    ->description('Assign an asset to requester and set the expected return date')
                    ->schema([
                        Select::make('user_id')
                            ->required()
                            ->label('Peminjam')
                            ->relationship('user', 'name'),
                        Select::make('alat_id')
                            ->required()
                            ->label('Nama Alat')
                            ->relationship('alat', 'name'),
                        DatePicker::make('due_at')
                        ->label('Due date'),
                        Textarea::make('note')
                        ->label('Catatan Tambahan')
                        ->columnSpanFull(),
                    ])->columns(3)
                    ->columnSpanFull(),

            ]);
    }
}
