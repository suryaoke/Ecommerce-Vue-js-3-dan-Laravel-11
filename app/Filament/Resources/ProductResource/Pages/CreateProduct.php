<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterCreate(): void
    {
        // Sync the colors to the pivot table
        if ($this->data['colors']) {
            $this->record->colors()->sync($this->data['colors']);
        }

        // Sync the sizes to the pivot table
        if ($this->data['sizes']) {
            $this->record->sizes()->sync($this->data['sizes']);
        }
    }
}
