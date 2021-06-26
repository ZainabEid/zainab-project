@extends('site.layouts.app')

@section('content')
    
<div id="review_form_wrapper">
    <div id="review_form">

        <div id="respond" class="comment-respond column-all">
            <div class="row justify-content-between">
                <h3 style="margin-bottom:10px;" id="reply-title" class="comment-reply-title column-left" >
                    Cart 
                    <small><a  href="{{ route('site.cart.clear') }}" class="column-right clearCart">clear <i class="fa fa-trash-o"></i></a>
                    </small>
                </h3>
            </div>



            <table id="cart-products-table" class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th >Photo</th>
                    <th >Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th class="text-center">Subtotal</th>
                    <th ></th>
                </tr>
                </thead>
                <tbody>
                    <?php $total = 0 ; $total_items = 0; ?>
                    @if(isset($cart))
                        @foreach($cart as $id => $cart_product)
                            <?php $total += $cart_product['price'] * $cart_product['quantity'] ?>
                            <?php $total_items += $cart_product['quantity'] ?>
                            @include('site.includes._cart_row')
                        @endforeach
                    @endif
                </tbody>
                
                <tfoot>
                <tr>
                    <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                    <td class="hidden-xs total_items" colspan="2"> {{ $total_items }} items</td>
                    <td class="hidden-xs text-center float-right" style="float:right;"  ><strong>Total</strong></td>
                    <td class="hidden-xs text-center total-price"><strong> ${{ $total }}</strong></td>
                    </td>
                    <td>
                        @if ($total > 0)
                        
                            {{-- <a href="{{ route('site.payment.paypal.getToken') }}">get Token</a> --}}
                            {{-- <a href="{{ route('site.payment.paypal.captureAuthorizedPayment') }}">Capture Authorized Payment</a> --}}
                            <a href="{{ route('site.payment.invoice-link') }}" class="btn btn-warning"> Get Invoice Link <i class="fa fa-angle-right"></i></a>
                            or
                            <a href="{{ route('site.payment.pay') }}" class="btn btn-warning"> Proceed to pay <i class="fa fa-angle-right"></i></a>
                            {{-- or --}}
                            {{-- <div id="paypal-button"></div> --}}
                           
                        @endif
                    </td>
                </tr>
                </tfoot>
            </table>

            
        </div>
        <!-- #respond -->
    </div>
</div>




@endsection