<?php

namespace App\Filament\Resources\AlatReturns\Pages;

use App\Filament\Resources\AlatReturns\AlatReturnResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAlatReturn extends ViewRecord
{
    protected static string $resource = AlatReturnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
