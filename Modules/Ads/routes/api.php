<?php

use Illuminate\Support\Facades\Route;

Route::Resource('/ad', 'AdsController')->except(['create', 'edit']);
Route::Resource('/category', 'CategoriesController')->except(['create', 'edit']);
Route::Resource('/tag', 'TagsController')->except(['create', 'edit']);
