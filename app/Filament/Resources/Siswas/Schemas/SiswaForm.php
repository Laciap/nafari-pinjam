<?php

namespace App\Filament\Resources\Siswas\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SiswaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->required()
                    ->label('Nama Siswa')
                    ->relationship('user', 'name'),
                Select::make('kelas_id')
                    ->required()
                    ->label('Kelas')
                    ->relationship('kelas', 'name'),
                TextInput::make('nisn')
                    ->required()
                    ->unique(ignoreRecord:true)
                    ->validationMessages(['unique' => 'NISN sudah terdaftar'])
                    ->label('NISN'),
                TextInput::make('phone_number')
                    ->tel()
                    ->required()
                    ->label('No. Telepon'),
                Select::make('gender')
                ->label('Jenis Kelamin')
                    ->options(['male' => 'Male', 'female' => 'Female'])
                    ->required(),
                Textarea::make('address')
                ->label('Alamat')
                ->default(null)
                    ->columnSpanFull(),
                FileUpload::make('profile_picture')
                    ->label('Foto Profil')
                    ->default(null)
                    ->directory('Siswa/Foto Profil')
                    ->disk('public')
                    ,
            ]);
    }
}
