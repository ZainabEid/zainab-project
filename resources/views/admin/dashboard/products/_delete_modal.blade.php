<div>
    <div class="modal-content">


        <div class="modal-header">

            <h5 class="modal-title" >Delete {{ $product->name }} </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
        
        <div class="modal-body">
            
            <label>Are you sure you want to delete this product ? </label>
        </div>
           
        <div class="modal-footer">
            {{-- delete btn --}}
            <button wire:click.prevent="destroy"   type="button" class="btn btn-info" >
               Yes, Delete the product
            </button>

        </div>

   

</div>
