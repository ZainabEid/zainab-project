<div>
    <tr >
        <td ><span>{{ isset($table_index) ? $table_index + 1 : '' }}.</span></td>
        <td >{{ $product->name ?? '' }}</td>
        <td > {{ $product->description ?? '' }}</td>
        <td >{{ $product->price ?? '' }}</td>
        <td >
            <img src="{{ get_image('products', $product->photo) }}" alt="{{ $product->name . '-image' }}" class=" img-thumbnail"
                style="height: 50px; width:50px;">
    
        </td>
    
        <td>
            <div class="row d-flex justify-content-around">
                {{-- delete product --}}
                <button wire:click="selectProduct({{ $product->id }} , 'delete')" class="btn btn-danger  btn-sm">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
    
                {{-- edit  product --}}
                <button wire:click="selectProduct({{ $product->id }}, 'edit')" type="button" class="btn btn-info btn-sm">
                    <i class="fa fa-edit" aria-hidden="true"></i>
                </button>
            </div>
    
            <div>
            </div>
        </td>
    </tr>
</div>
