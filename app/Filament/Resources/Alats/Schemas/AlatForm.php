<?php

namespace App\Filament\Resources\Alats\Schemas;

use App\Models\Alat;
use App\Models\Category;
use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class AlatForm
{
    protected static function recalculateStock(Get $get, Set $set): void
    {
        $good = (int) $get('good_qty');
        $damage = (int) $get('damaged_qty');
        $borrowed = (int) $get('borrowed_qty');
        $lost = (int) $get('lost_qty');

        $set('available_qty', $good - $borrowed);
        $set('total_qty', $good + $damage + $lost + $borrowed);
    }
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Fieldset::make('Kondisi Alat')
                            ->schema([
                                Select::make('category_id')
                                    ->required()
                                    ->relationship('category', 'name')
                                    ->label('Category')
                                    ->reactive()
                                    ->afterStateUpdated(function (Get $get, Set $set) {
                                        $category = Category::find($get('category_id'));

                                        if (!$category) {
                                            return;
                                        }
                                        $prefix = strtoupper(Str::substr($category->name, 0, 3));
                                        $lastCode = Alat::where('code', 'like', $prefix . '%')
                                            ->orderBy('code', 'desc')
                                            ->value('code');

                                        if ($lastCode) {

                                            $number = (int) substr($lastCode, 3);
                                            $nextNumber = $number + 1;
                                        } else {
                                            $nextNumber = 1;
                                        }

                                        $code = $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
                                        $set('code', $code);
                                    }),
                                TextInput::make('code')
                                    ->reactive()
                                    ->readOnly()
                                    ->required(),

                                TextInput::make('name')
                                    ->required()
                                    ->columnSpanFull(),

                                RichEditor::make('Description')
                                    ->label('Description')
                                    ->columnSpanFull()
                                    ->extraAttributes([
                                        'style' => 'min-height: 250px'
                                    ]),
                                FileUpload::make('image')
                                    ->label('Foto Alat')
                                    ->disk('public')
                                    ->directory('Foto Alat')
                                    ->default(null)
                                    ->columnSpanFull(),

                            ]),
                        Toggle::make('is_available')
                            ->label('Status')
                            ->required(),
                    ])->columnSpan(2),



                Fieldset::make('Kondisi Barang / Stock')
                    ->schema([
                        TextInput::make('good_qty')
                            ->numeric()
                            ->required()
                            ->label('Bagus')
                            ->default(0)
                            ->reactive()
                            ->afterStateUpdated(fn(Get $get, Set $set) => self::recalculateStock($get, $set)),
                        TextInput::make('damaged_qty')
                            ->numeric()
                            ->required()
                            ->label('Rusak')
                            ->default(0)
                            ->reactive()
                            ->afterStateUpdated(fn(Get $get, Set $set) => self::recalculateStock($get, $set)),
                        TextInput::make('borrowed_qty')
                            ->numeric()
                            ->required()
                            ->label('Dipinjam')
                            ->default(0)
                            ->reactive()
                            ->afterStateUpdated(fn(Get $get, Set $set) => self::recalculateStock($get, $set)),
                        TextInput::make('lost_qty')
                            ->numeric()
                            ->required()
                            ->label('Hilang')
                            ->default(0)
                            ->reactive()
                            ->afterStateUpdated(fn(Get $get, Set $set) => self::recalculateStock($get, $set)),
                        TextInput::make('available_qty')
                            ->required()
                            ->readOnly()
                            ->required()
                            ->label('Tersedia')
                            ->belowContent('Alat Tersedia untuk Dipinjam')
                            ->default(0),
                        TextInput::make('total_qty')
                            ->required()
                            ->readOnly()
                            ->required()
                            ->label('Total')
                            ->default(0),
                    ])->columnSpan(1),


            ])->columns(3);
    }
}
