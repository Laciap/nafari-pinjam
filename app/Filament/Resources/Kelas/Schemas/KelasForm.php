<?php

namespace App\Filament\Resources\Kelas\Schemas;

use App\Models\Jurusan;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\Relationship;

class KelasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('jurusan_id')
                    ->required()
                    ->label('Jurusan')
                    ->Relationship('jurusan', 'name')
                    ->options(Jurusan::where('is_active', true)->pluck('name', 'id')),
                TextInput::make('name')
                    ->required(),
                Select::make('level')
                    ->required()
                    ->label('Grade')
                    ->options([
                        10 => 'X',
                        11 => 'XI',
                        12 => 'XII',
                    ]),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
