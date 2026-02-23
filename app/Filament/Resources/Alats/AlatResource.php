<?php

namespace App\Filament\Resources\Alats;

use App\Filament\Resources\Alats\Pages\CreateAlat;
use App\Filament\Resources\Alats\Pages\EditAlat;
use App\Filament\Resources\Alats\Pages\ListAlats;
use App\Filament\Resources\Alats\Pages\ViewAlat;
use App\Filament\Resources\Alats\Schemas\AlatForm;
use App\Filament\Resources\Alats\Schemas\AlatInfolist;
use App\Filament\Resources\Alats\Tables\AlatsTable;
use App\Models\Alat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class AlatResource extends Resource
{
    protected static ?string $model = Alat::class;

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-computer-desktop';
    protected static string|BackedEnum|null $activeNavigationIcon = 'heroicon-s-computer-desktop';
    protected static string|UnitEnum|null $navigationGroup = 'Asset Management';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return AlatForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AlatInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AlatsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAlats::route('/'),
            'create' => CreateAlat::route('/create'),
            'view' => ViewAlat::route('/{record}'),
            'edit' => EditAlat::route('/{record}/edit'),
        ];
    }
}
