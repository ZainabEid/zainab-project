<?php

namespace App\Http\Livewire\Admin\Dashboard\Products;

use Livewire\Component;

class ProductRow extends Component
{
   public $product; 

    public function render()
    {
        return view('livewire.admin.dashboard.products.product-row');
    }
}
