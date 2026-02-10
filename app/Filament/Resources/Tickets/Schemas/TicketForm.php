<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('alat_id')
                    ->required()
                    ->numeric(),
                TextInput::make('ticket_number')
                    ->required(),
                TextInput::make('qty')
                    ->required()
                    ->numeric()
                    ->default(1),
                DateTimePicker::make('booked_at')
                    ->required(),
                DateTimePicker::make('borrowed_at'),
                DatePicker::make('due_at'),
                DateTimePicker::make('returned_at'),
            ]);
    }
}
