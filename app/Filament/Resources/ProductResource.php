<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Set;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->afterStateUpdated(function (Set $set, $state) {
                        $set('slug', Product::generateUniqueSlug($state));
                    })
                    ->required()
                    ->live(onBlur: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->readOnly()
                    ->maxLength(255),
                Forms\Components\TextInput::make('qty')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\Textarea::make('desc')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('thumbnail')
                    ->required()
                    ->image(),
                Forms\Components\FileUpload::make('first_image')
                    ->image(),
                Forms\Components\FileUpload::make('second_image')
                    ->image(),
                Forms\Components\FileUpload::make('third_image')
                    ->image(),
                Forms\Components\Toggle::make('status')
                    ->required(),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name'),
                Forms\Components\Select::make('brand_id')
                    ->relationship('brand', 'name'),

                // Product Colors Select
                Forms\Components\Select::make('colors')
                    ->multiple()
                    ->options(\App\Models\Color::all()->pluck('name', 'id')) // Fetch all colors
                    ->placeholder('Select Colors')
                    ->required(),

                // Product Size Select
                Forms\Components\Select::make('sizes')
                    ->multiple()
                    ->options(\App\Models\Size::all()->pluck('name', 'id')) // Fetch all sizes
                    ->placeholder('Select Sizes')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                ->searchable(),
                Tables\Columns\TextColumn::make('qty')
                ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                ->money()
                    ->sortable(),
                // Display images in two per row
                Tables\Columns\TextColumn::make('images')
                ->label('Images')
                ->getStateUsing(function ($record) {
                    $images = [];
                    // Start a div to hold the images
                    $images[] = '<div style="display: flex; flex-wrap: wrap;">';

                    // Add images with a fixed size and margin, two per row
                    if ($record->thumbnail) {
                        $images[] = '<div style="width: 50%; padding: 5px; box-sizing: border-box; display: flex; justify-content: center;">
                                        <img src="' . asset('storage/' . $record->thumbnail) . '" alt="Thumbnail" style="width: 50px; height: 50px;" />
                                      </div>';
                    }
                    if ($record->first_image) {
                        $images[] = '<div style="width: 50%; padding: 5px; box-sizing: border-box; display: flex; justify-content: center;">
                                        <img src="' . asset('storage/' . $record->first_image) . '" alt="First Image" style="width: 50px; height: 50px;" />
                                      </div>';
                    }
                    if ($record->second_image) {
                        $images[] = '<div style="width: 50%; padding: 5px; box-sizing: border-box; display: flex; justify-content: center;">
                                        <img src="' . asset('storage/' . $record->second_image) . '" alt="Second Image" style="width: 50px; height: 50px;" />
                                      </div>';
                    }
                    if ($record->third_image) {
                        $images[] = '<div style="width: 50%; padding: 5px; box-sizing: border-box; display: flex; justify-content: center;">
                                        <img src="' . asset('storage/' . $record->third_image) . '" alt="Third Image" style="width: 50px; height: 50px;" />
                                      </div>';
                    }

                    // Close the container div
                    $images[] = '</div>';

                    return implode('', $images); // Join all images into a single HTML string
                })
                    ->html() // Render the HTML
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                ->boolean(),
                Tables\Columns\TextColumn::make('category.name')
                ->sortable(),
                Tables\Columns\TextColumn::make('brand.name')
                ->sortable(),

                // Display Product Colors
                Tables\Columns\TextColumn::make('colors.name')
                ->label('Colors')
                ->sortable(),

                // Display Product Sizes
                Tables\Columns\TextColumn::make('sizes.name')
                ->label('Sizes')
                ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
