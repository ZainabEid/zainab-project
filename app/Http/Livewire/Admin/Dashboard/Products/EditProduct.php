<?php

namespace App\Http\Livewire\Admin\Dashboard\Products;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProduct extends Component
{

    use WithFileUploads;

    public $product;
    public $categories;

    public $category_id;
    public $name_ar;
    public $name_en;
    public $description_ar;
    public $description_en;
    public $price;
    public $photo;

    protected $rules = [
        'category_id' => 'required',
        'name_ar' => 'required',
        'name_en' => 'required',
        'description_ar' => 'required',
        'description_en' => 'required',
        'price' => 'required',
        'photo' => 'nullable|image',
    ];
    


    public function mount($product)
    {
        $this->product = $product;

        $this->category_id = $product->category_id;
        $this->name_ar = $product->name_ar;
        $this->name_en = $product->name_en;
        $this->description_ar = $product->description_ar;
        $this->description_en = $product->description_en;
        $this->price = $product->price;

    }

    public function update()
    {
        $this->validate();

        $data = [
            'category_id' => $this->category_id,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'price' => $this->price,
            'photo' => $this->product->photo,
        ];

        if ($this->photo) {

            $data['photo'] = basename(save_image('products', $this->photo));
        }

        $this->product->update($data);

        $this->emit('refreshProductsTable');
        $this->dispatchBrowserEvent('close-modal');
        $this->cleanVars();
    }

    public function cleanVars()
    {
        $this->category_id = null;
        $this->name_ar = null;
        $this->name_en = null;
        $this->description_ar = null;
        $this->description_en = null;
        $this->price = null;
        $this->photo = null;
    }
    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.admin.dashboard.products.edit-product');
    }
}
