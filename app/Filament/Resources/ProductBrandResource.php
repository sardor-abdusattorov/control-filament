<?php

namespace App\Filament\Resources;

use AbdulMajeediJamaan\FilamentTranslatableTabs\Forms\TranslatableTabs;
use App\Filament\Resources\ProductBrandResource\Pages;
use App\Filament\Resources\ProductBrandResource\RelationManagers;
use App\Models\ProductBrand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductBrandResource extends Resource
{
    protected static ?string $model = ProductBrand::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'Products';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('Product Brands');
    }

    public static function getModelLabel(): string
    {
        return __('Product Brand');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Product Brands');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Brand Information'))
                    ->schema([
                        TranslatableTabs::make()
                            ->locales(['ru', 'uz', 'en'])
                            ->columnSpanFull()
                            ->defaultLocale('ru')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('Brand Name'))
                                    ->required()
                                    ->maxLength(255),
                            ]),

                        Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                            ->label(__('Brand Image'))
                            ->collection('product_brand')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->maxSize(5120)
                            ->columnSpanFull(),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('sort')
                                    ->label(__('Sort Order'))
                                    ->numeric()
                                    ->default(0)
                                    ->required(),

                                Forms\Components\Toggle::make('status')
                                    ->label(__('Status'))
                                    ->default(true)
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->label(__('Image'))
                    ->collection('product_brand')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('Brand Name'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort')
                    ->label(__('Sort Order'))
                    ->numeric()
                    ->sortable(),

                Tables\Columns\IconColumn::make('status')
                    ->label(__('Status'))
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Updated At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListProductBrands::route('/'),
            'create' => Pages\CreateProductBrand::route('/create'),
            'view' => Pages\ViewProductBrand::route('/{record}'),
            'edit' => Pages\EditProductBrand::route('/{record}/edit'),
        ];
    }
}
