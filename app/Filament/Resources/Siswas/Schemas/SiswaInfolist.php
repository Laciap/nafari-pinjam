<?php

namespace App\Filament\Resources\Siswas\Schemas;

use Filament\Schemas\Schema;
use PhpParser\Node\Stmt\Label;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;

class SiswaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make()

                    ->schema([
                        ImageEntry::make('profile_picture')
                            ->disk('public')
                            ->imageHeight(200)
                            ->hiddenLabel()
                            ->alignCenter(),
                    ])->columnSpan(1),

                Section::make()

                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Nama Siswa')
                            ->icon(Heroicon::UserCircle),
                        TextEntry::make('nisn')
                            ->label('nisn')
                            ->icon(Heroicon::Identification),
                        TextEntry::make('kelas.name')
                            ->label('kelas')
                            ->icon(Heroicon::BuildingOffice),

                        TextEntry::make('phone_number')
                            ->label('nomor telephone')
                            ->icon(Heroicon::Phone),
                        TextEntry::make('gender')
                            ->label('gender')
                            ->badge(),
                    ])->columnSpan(2)
                    ->columns(3),



            ])->columns(3);
    }
}
