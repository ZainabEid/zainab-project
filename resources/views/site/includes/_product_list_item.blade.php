<li class="product">
    <a href="#">
        {{-- <span class="onsale">Sale!</span> --}}
        <img src="{{ get_image( 'products' ,$product->photo) }}"
            style="height: 100px; width:100px;"
            class=" attachment-post-thumbnail size-post-thumbnail wp-post-image"
            alt="">
        <h3> {{ $product->name }}</h3>
        <span class="price"><span class="amount"> {{ $product->price }}</span></span>
    </a>
    <a href="#" data-url="{{ route('site.addToCart', $product->id) }}" class="button addToCart">Add to cart</a>
</li>