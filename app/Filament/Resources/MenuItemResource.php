<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuItemResource\Pages;
use App\Models\MenuItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Table;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Menu Item Name')
                    ->placeholder('Enter the name of the menu item')
                    ->required()
                    ->maxLength(255)
                    ->helperText('The name should be unique and descriptive.'),

                Forms\Components\RichEditor::make('description')
                    ->label('Description')
                    ->placeholder('Enter a detailed description of the menu item')
                    ->required()
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold', 'italic', 'underline', 'strike',
                        'link', 'orderedList', 'bulletList',
                        'blockquote', 'codeBlock', 'heading', 'horizontalRule',
                        'undo', 'redo'
                    ])
                    ->helperText('Provide a detailed description of the menu item, including ingredients and special features.'),

                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->placeholder('Enter the price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->helperText('The price should be a valid number.'),

                Forms\Components\Select::make('categories')
                    ->label('Categories')
                    ->placeholder('Select categories')
                    ->multiple()
                    ->relationship('categories', 'name')
                    ->helperText('You can select multiple categories.'),

                Forms\Components\FileUpload::make('image')
                    ->label('Upload Image')
                    ->image()
                    ->placeholder('Choose an image')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                    ->maxSize(5120)
                    ->required()
                    ->helperText('Accepted file types: jpg, jpeg, png. Max size: 2MB.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('idr')
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->html()
                    ->limit(75),
                Tables\Columns\ImageColumn::make('image'),
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                ActionGroup::make([
                    DeleteAction::make(),
                ]),
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
            'index' => Pages\ListMenuItems::route('/'),
            'create' => Pages\CreateMenuItem::route('/create'),
            'edit' => Pages\EditMenuItem::route('/{record}/edit'),
        ];
    }
}
