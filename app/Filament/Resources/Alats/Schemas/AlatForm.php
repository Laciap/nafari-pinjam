<?php

namespace App\Filament\Resources\Alats\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class AlatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Fieldset::make('Kondisi Alat')
                            ->schema([
                                TextInput::make('code')
                                    ->required(),
                                Select::make('category_id')
                                    ->required()
                                    ->relationship('category', 'name')
                                    ->label('Category'),
                                TextInput::make('name')
                                    ->required()
                                    ->columnSpanFull(),

                            ]),
                        Toggle::make('is_available')
                            ->label('Status')
                            ->required(),
                    ])->columnSpan(2),



                Fieldset::make('Kondisi Barang')
                    ->schema([
                        TextInput::make('good_qty')
                            ->required()
                            ->label('Bagus')
                            ->default(0),
                        TextInput::make('damaged_qty')
                            ->required()
                            ->label('Rusak')
                            ->default(0),
                        TextInput::make('borrowed_qty')
                            ->required()
                            ->label('Dipinjam')
                            ->default(0),
                        TextInput::make('lost_qty')
                            ->required()
                            ->label('Hilang')
                            ->default(0),
                        TextInput::make('total_qty')
                            ->required()
                            ->label('Total')
                            ->default(0),
                    ])->columnSpan(1),


            ])->columns(3);
    }
}
