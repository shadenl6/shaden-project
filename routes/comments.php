<?php

use App\Http\Controllers;

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
