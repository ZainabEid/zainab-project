<div>
    <div class="modal-content">


        <div class="modal-header">

            <h5 class="modal-title" >Add New Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
        
        <div class="modal-body">
            
            @include('admin.dashboard.products._form')

        </div>
           
        <div class="modal-footer">
            {{-- add  new product --}}
            <button wire:click.prevent="store"   type="button" class="btn btn-info" >
                add new product
            </button>

        </div>
    </div>

   
</div>
