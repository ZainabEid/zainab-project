<?php

namespace App\Http\Livewire\Admin\Dashboard\Products;

use App\Models\Product;
use Livewire\Component;

class DeleteProduct extends Component
{
    public $product;

    public function mount(Product $product)
      {
          $this->product = $product;
      }
  
    public function destroy()
    {
        delete_image('products',  $this->product->photo);
        $this->product->delete();
        
        $this->emit('refreshProductsTable');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.admin.dashboard.products.delete-product');
    }
}
