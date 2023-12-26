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
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;



class PostsResource extends Resource
{
    protected static ?string $model = Posts::class;

    protected static ?string $navigationIcon = 'heroicon-s-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
             -> schema ( [
                Section:: make( 'Create a Post')
                   ->description ('create posts over here.')
                      ->schema ( [
                         TextInput::make ('title')->required (),
                         TextInput::make ('slug')->required (),
                         Select::make('category') // Renamed from status to category
                        ->options([
                           'PHP' => 'PHP',
                           'Laravel' => 'Laravel',
                           'Livewire' => 'Livewire',
                                ]),

                        ColorPicker::make('color')->required (),
                        MarkdownEditor::make('content')->required () -> columnSpanFull (),
                         ]) ->columnSpan (2) ->columns (2),
                    Group::make () ->schema([
                        Section::make("Image")
                           ->collapsible ()
                           ->schema([
                    FileUpload::make('thumbnail')->disk('public')->directory('thumbnails'),
                     ]) ->columnSpan (1) ,
                        Section::make ( 'Meta' )->schema ([
                        TagsInput::make ('tags')->required(),
                        Checkbox::make('published')->required(),
                        ])
                        ]),
                        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                ->disk('public') // Specify the disk if different from the default
                ->url(fn ($record) => $record->thumbnails_url), // Assuming you have an accessor for the URL

                Tables\Columns\TextColumn::make('color'),
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('content')
                    ->limit(50), // Limit the content displayed
                
                Tables\Columns\TagsColumn::make('tags'),
                Tables\Columns\BooleanColumn::make('published')
                    ->label('Published Status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->label('published on'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->sortable(),
                // Add any additional columns you need here
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                // You can add more actions if necessary
            ])
            ->filters([
                //
            ])
            // ->actions([
            //     Tables\Actions\EditAction::make(),
            // ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //AuthorsRelationManager::class,
            //CommentRelationManager::class

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
