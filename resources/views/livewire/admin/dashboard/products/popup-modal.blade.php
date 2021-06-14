<div>
   
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
          
            @isset($photo)
            Photo Preview:
            <img src="{{ $photo->temporaryUrl() }}" class=" img-thumbnail"
                style="height: 50px; width:50px;">
     
            @endisset

        </div>
    
     
        
        {{-- add  new product --}}
        <button wire:click.prevent="addProduct"   type="button" class="btn btn-info" >
            add new product
        </button>
</div>
