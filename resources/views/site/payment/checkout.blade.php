@extends('site.layouts.app')

@section('content')
    	<!-- #masthead -->
		<div id="content" class="site-content">
			<div id="primary" class="content-area column column-third">
				<main id="main" class="site-main">
				<article id="post-39" class="post-39 page type-page status-publish hentry">
				<header class="entry-header">
				<h1 class="entry-title">Checkout Page</h1>
				</header>
				<!-- .entry-header -->
				<div class="entry-content">
					<div class="">
						<h4><strong>Choose the payment Method:</strong></h4>						
						{!! Form::open(['route'=>'site.payment.pay' ,'role' => 'form', 'method' => 'POST', ]) !!}
							<div class="form">
								{{-- payment methods --}}
								
								@foreach ($paymentMethods as $pm)
								<p>
										<input type="radio" name="PaymentMethodId" value="{{ $pm->PaymentMethodId }}" id="">
										<img src="{{ url($pm->ImageUrl) }}"  width="30" height="30" alt=""> 
										{{ $pm->PaymentMethodEn }}
									</p>
									@endforeach

								{{-- <p>Name on Card<input type="text" name="name" placeholder=""></p>
								<p>Card Number<input type="text" name="card_number" placeholder=""></p>
								<p>Expiration Date<input type="text" max="5" name="Exp_date" placeholder="mm/yy"></p>
								<p>CVV<input type="text" maxlength="3"  name="ccv"></p>--}}
								<input type="submit" class="btn btn-success" value="pay"> 
							</div>
						</form>

						<div class="done">								
							Your message has been sent. Thank you!
						</div>
						
					</div>
				</div>
				<!-- .entry-content -->
				</article>
				</main>
				<!-- #main -->
			</div>
			<!-- #primary -->
		</div>
		<!-- #content -->
@endsection