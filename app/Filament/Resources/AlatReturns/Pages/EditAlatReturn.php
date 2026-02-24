<?php

namespace App\Filament\Resources\AlatReturns\Pages;

use App\Filament\Resources\AlatReturns\AlatReturnResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAlatReturn extends EditRecord
{
    protected static string $resource = AlatReturnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
