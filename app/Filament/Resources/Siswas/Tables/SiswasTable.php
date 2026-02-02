<?php

namespace App\Filament\Resources\Siswas\Tables;

use Filament\Actions\ActionGroup;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Stack;

class SiswasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->contentGrid([
                'xl' => 4,
                'lg' => 3,
                'md' => 2,
            ])
            ->columns([
                Grid::make([
                    'default' => 1,
                ])->schema([

                    ImageColumn::make('profile_picture')
                        ->label('Foto Profil')
                        ->disk('public')
                        ->imageSize(200),

                    Stack::make([
                        TextColumn::make('user.name')
                            ->label('Nama Siswa')
                            ->searchable()
                            ->sortable()
                            ->weight(FontWeight::Bold),

                        TextColumn::make('nisn')
                            ->label('NISN')
                            ->searchable()
                            ->icon(Heroicon::Identification),
                        TextColumn::make('kelas.name')
                            ->label('Kelas')
                            ->searchable()
                            ->sortable()
                            ->icon(Heroicon::BuildingOffice),
                        TextColumn::make('phone_number')
                            ->label('No. Telepon')
                            ->searchable()
                            ->icon(Heroicon::Phone),
                        TextColumn::make('gender')
                            ->label('Jenis Kelamin')
                            ->badge(),
                    ])

                ]),


            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),

                ActionGroup::make([
                   EditAction::make(),
                DeleteAction::make(), 
                ]),
                
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
