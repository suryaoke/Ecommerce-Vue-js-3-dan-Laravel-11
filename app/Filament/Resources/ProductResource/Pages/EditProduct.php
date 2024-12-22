<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Prepopulate the colors and sizes relationship data
        $data['colors'] = $this->record->colors()->pluck('colors.id')->toArray();
        $data['sizes'] = $this->record->sizes()->pluck('sizes.id')->toArray();

        return $data;
    }

    protected function afterSave(): void
    {
        // Sync the pivot table with the selected colors and sizes
        $this->record->colors()->sync($this->form->getState()['colors']);
        $this->record->sizes()->sync($this->form->getState()['sizes']);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
