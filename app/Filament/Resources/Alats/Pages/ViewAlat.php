<?php

namespace App\Filament\Resources\Alats\Pages;

use App\Filament\Resources\Alats\AlatResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAlat extends ViewRecord
{
    protected static string $resource = AlatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
