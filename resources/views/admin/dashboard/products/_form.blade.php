<div class="form-group">
    <select wire:model='category_id' class="form-select" aria-label="select example" >
        <option selected value="{{ null }}"> <label for="category_id" class="boldfont">Choose Category</label></option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
    @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
</div>

<div class="form-group">
    <label for="name_ar" class="boldfont">name-ar</label>
    <input wire:model.prevent="name_ar" type="text" >
    @error('name_ar') <span class="text-danger">{{ $message }}</span> @enderror
</div>

<div class="form-group">
    <label for="name_en" class="boldfont">name-en</label>
    <input wire:model.prevent="name_en" type="text">
    @error('name_en') <span class="text-danger">{{ $message }}</span> @enderror
  
</div>

<div class="form-group">
    <label for="description_ar" class="boldfont">description_ar</label>
    <input wire:model.prevent="description_ar" type="text" >
    @error('description_ar') <span class="text-danger">{{ $message }}</span> @enderror
   
</div>


<div class="form-group">
    <label for="description_en" class="boldfont">description_en</label>
    <input wire:model.prevent="description_en" type="text">
    @error('description_en') <span class="text-danger">{{ $message }}</span> @enderror
  
</div>


<div class="form-group">
    <label for="price" class="boldfont">price</label>
    <input wire:model.prevent="price" type="number" >
    @error('price') <span class="text-danger">{{ $message }}</span> @enderror
    
</div>

<div class="form-group">
    <label for="photo" class="boldfont">photo</label>
    <input type="file" wire:model="photo">
    @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
</div>
    
<div class="form-group">
    <label for="photoPreview" class="boldfont">Photo Preview:</label>
   
    @php
        if ($photo) {
           $imagePreviewSrc = $photo->temporaryUrl();
        }elseif (isset($product)) {
           $imagePreviewSrc = get_image('products', $product->photo);
        }else{
           $imagePreviewSrc = get_image('products', 'default.png');
        }
    @endphp
    
    <img src="{{ $imagePreviewSrc }}" class=" img-thumbnail"
        style="height: 50px; width:50px;">
</div>



