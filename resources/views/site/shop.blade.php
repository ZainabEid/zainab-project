@extends('site.layouts.app')

@section('content')

	<!-- #masthead -->
    <div id="content" class="site-content">
        <div id="primary" class="content-area column two-thirds">
            <main id="main" class="site-main" role="main">
                <p class="woocommerce-result-count">
                    Showing 1–8 of {{ $products->count() }} results
                </p>
                

                {{-- <form class="woocommerce-ordering" method="get">
                    <select name="orderby" class="orderby">
                        <option value="menu_order" selected="selected">Default sorting</option>
                        <option value="popularity">Sort by popularity</option>
                        <option value="rating">Sort by average rating</option>
                        <option value="date">Sort by newness</option>
                        <option value="price">Sort by price: low to high</option>
                        <option value="price-desc">Sort by price: high to low</option>
                    </select>
                </form> --}}

                <ul class="products">
                
                    @foreach ($products as $index => $product)
                        @include('site.includes._product_list_item')
                    @endforeach
                    
                </ul>

                <nav class="woocommerce-pagination">
                    <ul class="page-numbers">
                        <li><span class="page-numbers current">1</span></li>
                        <li><a class="page-numbers" href="#">2</a></li>
                        <li><a class="next page-numbers" href="#">→</a></li>
                    </ul>
                </nav>
            </main>
            <!-- #main -->
        </div>
        <!-- #primary -->


        {{-- cart --}}
        <div id="secondary" class="column third">
            <div class="widget-area">
                <aside class="widget">
                    <article id="post-37" class="post-37 page type-page status-publish hentry">

                        <div class="entry-content">
                            <div class="wpcmsdev-toggle">
        
                                <h3 class="toggle-title">
                                    <a href="#clickToOpen">
                                        <i class="fa fa-plus icon-for-inactive"></i>
                                        <i class="fa fa-minus icon-for-active"></i>
                                        CART
                                    </a>
                                </h3>
        
                                <div id="clickToOpen" class="toggle-content">
                                    <table id="cart" class="table table-hover table-condensed">

                                        <thead>
                                            <tr>
                                                <th style="width:50%">Product</th>
                                                <th style="width:20%">Price</th>
                                                <th style="width:30%">Quantity</th>
                                            </tr>
                                        </thead>

                                        <tbody id="cart-products-table">
                                            @if(isset($cart))

                                                @foreach($cart as $product_id => $cart_product)

                                                    @include('site.includes._cart_row')

                                                @endforeach

                                            
                                            @else
                                                <tr class="no-product">
                                                    <td class="text-center" ><strong > No Products Yet </strong></td>
                                                </tr>
                                            @endif
                                        </tbody>

                                        <tfoot>
                                            <tr class="visible-xs">

                                                <td class=" text-center"><strong>Total:</strong></td>
                                                <td class=" text-center"><strong class="total-price">${{session()->get('total_price') }}</strong></td>
                                                <td class=" text-center"><a href="{{ route('site.cart.clear') }}" class="clearCart">clear <i class="fa fa-trash-o"></i></a></td>
                                            </tr>
                                        
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </aside>
            </div>
        </div>
    </div>
    <!-- #content -->
    
@endsection