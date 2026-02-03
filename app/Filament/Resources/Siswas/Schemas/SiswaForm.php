<?php

namespace App\Filament\Resources\Siswas\Schemas;

use App\Models\Siswa;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;

class SiswaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->required()
                    ->label('Nama Siswa')
                    ->relationship('user', 'name', fn($query) => $query->role('siswa'))
                    ->disableOptionWhen(fn($value) => Siswa::where('user_id', $value)->exists())
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord:true),
                        Select::make('roles')
                            ->relationship('roles', 'name')
                            ->label('Role')
                            ->required(),
                        DateTimePicker::make('email_verified_at'),
                        TextInput::make('password')
                            ->password()
                            ->required(),
                    ]),
                Select::make('kelas_id')
                    ->required()
                    ->label('Kelas')
                    ->relationship('kelas', 'name'),
                TextInput::make('nisn')
                    ->required()
                    ->unique(ignoreRecord: true)
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
                    ->disk('public'),
            ]);
    }
}
