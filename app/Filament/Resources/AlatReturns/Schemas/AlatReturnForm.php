<?php

namespace App\Filament\Resources\AlatReturns\Schemas;

use App\Models\Ticket;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class AlatReturnForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('ticket_id')
                    ->required()
                    ->label('Nomor Tiket')
                    ->relationship('ticket','ticket_number', fn($query) => $query->where('status','verifying'))
                    ->afterStateUpdated(fn($state, $set)=>
                    $set('alat_id', Ticket::find($state)?->alat_id ))
                    ->live(),
                Select::make('user_id')
                    ->required()
                    ->label('Diverifikasi oleh')
                    ->relationship('user', 'name')
                    ->default(Auth::id())
                    ->hidden()
                    ->dehydrated(),
                Select::make('alat_id')
                    ->required()
                    ->label('Nama Alat')
                    ->relationship('alat', 'name')
                    ->disabled()
                    ->dehydrated(),
                TextInput::make('qty')
                    ->required()
                    ->numeric()
                    ->default(fn(callable $get)=>Ticket::find($get('ticket_id'))?->qty ?? 1)
                    ->readOnly(),
                Select::make('condition')
                    ->options(['good' => 'Good', 'damaged' => 'Damaged', 'lost' => 'Lost'])
                    ->default('good')
                    ->required(),
                DateTimePicker::make('returned_at')
                    ->required()
                    ->default(Carbon::now())
                    ->hidden()
                    ->dehydrated(),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
