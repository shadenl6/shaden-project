<?php

namespace App\Filament\Resources\PostsResource\Pages;

use App\Filament\Resources\PostsResource;
use Filament\Pages\Page;  // Use the correct base class for listing records
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Forms\Components\Text;
use Filament\Resources\Forms\Components\Textarea;
use Filament\Models\Post;  // Import the Post model

class Posts extends Page
{  // Extend Page for listing records

    public function getTitle(): string
{
    return 'Posts';  // Ensure return type is explicitly string
}

    public function list()
    {
        return ListRecords::make('posts')
            ->model(Post::class)
            ->columns([
                Text::make('title')->label('Title'),
                Text::make('content')->label('Content'),
            ])  // Exclude 'comments' from listing
            ->sortBy('created_at')
            ->actions([
                Action::make('edit')  // Add "Edit" action for each record
                    ->label('Edit')
                    ->url(fn (Post $record): string => route('filament.posts.edit', $record)),
            ]);
    }

    public function actions()
    {
        return [
            Action::make('create')
                ->label('Create Post')
                ->url(route('filament.posts.create')),
        ];
    }
}
