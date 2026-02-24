<?php

namespace App\Filament\Resources\AlatReturns\Pages;

use App\Filament\Resources\AlatReturns\AlatReturnResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAlatReturns extends ListRecords
{
    protected static string $resource = AlatReturnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
