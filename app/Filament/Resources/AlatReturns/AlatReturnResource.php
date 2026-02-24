<?php

namespace App\Filament\Resources\AlatReturns;

use App\Filament\Resources\AlatReturns\Pages\CreateAlatReturn;
use App\Filament\Resources\AlatReturns\Pages\EditAlatReturn;
use App\Filament\Resources\AlatReturns\Pages\ListAlatReturns;
use App\Filament\Resources\AlatReturns\Pages\ViewAlatReturn;
use App\Filament\Resources\AlatReturns\Schemas\AlatReturnForm;
use App\Filament\Resources\AlatReturns\Schemas\AlatReturnInfolist;
use App\Filament\Resources\AlatReturns\Tables\AlatReturnsTable;
use App\Models\AlatReturn;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AlatReturnResource extends Resource
{
    protected static ?string $model = AlatReturn::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return AlatReturnForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AlatReturnInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AlatReturnsTable::configure($table);
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
            'index' => ListAlatReturns::route('/'),
            'create' => CreateAlatReturn::route('/create'),
            'view' => ViewAlatReturn::route('/{record}'),
            'edit' => EditAlatReturn::route('/{record}/edit'),
        ];
    }
}
