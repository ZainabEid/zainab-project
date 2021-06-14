<?php

use App\Http\Livewire\Admin\Dashboard\Products\Product;
use Illuminate\Support\Facades\Route;

## products routes
Route:: get('/products', Product::class)->name('products.index');