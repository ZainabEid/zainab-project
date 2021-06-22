<tr id="{{ $cart_product['id']  }}">

    {{-- photo --}}
    <td  data-th="Product">
            <div class="col-sm-3 hidden-xs"><img src="{{ get_image('products', $cart_product['photo'] ) }}" width="30" height="30" class="img-responsive"/></div>
    </td>

    {{-- product --}}
    <td  data-th="Product">
                <h4 class="nomargin">{{ $cart_product['name'] }}</h4>
    </td>
    
    {{-- price --}}
    <td  data-th="Price" class="product-price">${{ $cart_product['price'] }}</td>
    
    {{-- quantity --}}
    <td  data-th="Quantity">

        <input type="number" step="1" min="1" max="" name="quantity" 
        value="{{ $cart_product['quantity'] }}" title="Qty" 
        class="quantity input-text qty text" size="1"
        data-url = "{{ route('site.cart.change-quantity',  $cart_product['id'] ) }}" 
        />

    </td>

    {{-- subtotal --}}
    <td data-th="Subtotal" class="subtotal text-center">${{ $cart_product['price'] * $cart_product['quantity'] }}</td>
  
    {{-- action --}}
    <td class="actions" data-th="">
        <button class="btn btn-info btn-sm update-cart" data-id="{{ $cart_product['id'] }}"><i class="fa fa-refresh"></i></button>
        <a href="{{ route('site.cart.removeItem',$cart_product['id'] ) }}" class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $cart_product['id'] }}"><i class="fa fa-trash-o"></i></a>
    </td>
    
</tr>