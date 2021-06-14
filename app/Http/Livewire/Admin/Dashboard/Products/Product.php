<?php

namespace App\Http\Livewire\Admin\Dashboard\Products;

use App\Models\Product as ProductModel;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;

    public $products;

    public $product = null;

    public $action;



    protected  $listeners = [
        'refreshProductsTable' => '$refresh'
    ];


    ###### mount #####
    public function mount()
    {
        $this->products = ProductModel::all();
    }


    ###### open modals funcitons #####
    public function createProduct()
    {
        $this->action = "add";
        $this->dispatchBrowserEvent('open-modal');
    }

    public function selectProduct(ProductModel $product, $action)
    {
        $this->product = $product;
        $this->action = $action;
        $this->dispatchBrowserEvent('open-modal');
    }

    ###### delete function #########
    public function destroy()
    {
        delete_image('products',  $this->product->photo);
        $this->product->delete();
        $this->dispatchBrowserEvent('close-modal');
    }

    ###### render #####

    public function render()
    {
        $this->products = ProductModel::all();
        return view('livewire.admin.dashboard.products.product')
                ->extends('admin.dashboard.layouts.app')
                ->section('content');
    }
}
