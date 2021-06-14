<?php

namespace App\Http\Livewire\Admin\Dashboard\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class PopupModal extends Component
{
    use WithFileUploads;

   
    public $name_ar;
    public $name_en;
    public $description_ar;
    public $description_en;
    public $price;
    public $photo;


    protected $rules = [
        'name_ar' => 'required',
        'name_en' => 'required',
        'description_ar' => 'required',
        'description_en' => 'required',
        'price' => 'required',
        'photo' => 'nullable|image',
    ];

    public function addProduct()
    {
        $this->validate();

        $data = [
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'price' => $this->price,
            'photo' => 'default.png',
        ];

        if($this->photo){

         $data['photo'] = basename( save_image('products', $this->photo) );
        }

        Product::create($data);

        $this->emit('refreshProductsTable');
        $this->dispatchBrowserEvent('close-modal');
        $this->cleanVars();
    }

    public function cleanVars()
    {
        $this->name_ar = null;
        $this->name_en = null;
        $this->description_ar = null;
        $this->description_en = null;
        $this->price = null;
        $this->photo = null;
    }


    
    public function render()
    {
        return view('livewire.admin.dashboard.products.popup-modal');
    }
}
