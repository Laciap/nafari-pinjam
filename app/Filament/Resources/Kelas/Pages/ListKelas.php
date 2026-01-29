<?php

namespace App\Filament\Resources\Kelas\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Kelas\KelasResource;

class ListKelas extends ListRecords
{
    protected static string $resource = KelasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    
public function getTabs(): array
{
    return [
        'all' => Tab::make(),
        'grade_10' => Tab::make('Kelas X')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('level', 10)),
        'grade_11' => Tab::make('Kelas XI')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('level', 11)),
        'grade_12' => Tab::make('Kelas XII')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('level', 12)),
    ];

}
}