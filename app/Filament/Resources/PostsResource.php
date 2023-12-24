<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostsResource\Pages;
use App\Filament\Resources\PostsResource\RelationManagers;
use App\Models\Posts;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select\Category;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;

// class PostResource extends Resource
// {
//     protected static ?string $model = Posts::class;

//     protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

//     public static function form(Form $form): Form
//     {
//         return $form
//             ->schema([
//                 TextInput::make('title')->required(),
//                 TextInput::make('slug')->required(),
                
//                 Select::make('category') // Renamed from status to category
//                 ->options([
//                     'PHP' => 'PHP',
//                     'Laravel' => 'Laravel',
//                     'Livewire' => 'Livewire',
//                 ]),

//                 ColorPicker::make('color')->required(),
//                 MarkdownEditor::make('content')->required(),
//                 FileUpload::make('thumbnail') // Corrected spelling
//                     ->disk('public')
//                     ->directory('thumbnails'),
//                 TagsInput::make('tags')->required(),
//                 Checkbox::make('published')->required(),
//             ]);
//     }


class PostsResource extends Resource
{
    protected static ?string $model = Posts::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                TextInput::make('slug')->required(),
                
                Select::make('category') // Renamed from status to category
                ->options([
                    'PHP' => 'PHP',
                    'Laravel' => 'Laravel',
                    'Livewire' => 'Livewire',
                ]),

                ColorPicker::make('color')->required(),
                MarkdownEditor::make('content')->required(),
                FileUpload::make('thumbnail') // Corrected spelling
                    ->disk('public')
                    ->directory('thumbnails'),
                TagsInput::make('tags')->required(),
                Checkbox::make('published')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePosts::route('/create'),
            'edit' => Pages\EditPosts::route('/{record}/edit'),
        ];
    }
}
