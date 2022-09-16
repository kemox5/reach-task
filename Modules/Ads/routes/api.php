<?php

use Illuminate\Support\Facades\Route;

Route::Resource('/ad', 'AdsController')->except(['create', 'edit']);
