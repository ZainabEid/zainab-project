@extends('site.layouts.app')

@section('content')
    	<!-- #masthead -->
		<div id="content" class="site-content">
			<div id="primary" class="content-area column full">
				<main id="main" class="site-main">
				<article id="post-39" class="post-39 page type-page status-publish hentry">
				<header class="entry-header">
				<h1 class="entry-title">Go To Payment Link Page</h1>
				</header>
				<!-- .entry-header -->
				<div class="entry-content">
					<div class="">
						<h4>Payment Link</h4>						
						<div>	
								
							@if (filter_var($paymentLink, FILTER_VALIDATE_URL))
								Click on <a href='{{ $paymentLink }}' target='_blank'>{{ $paymentLink }}</a>.
							@else
								Click on  {!!  $paymentLink  !!}
							@endif
							
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
		@push('scripts')
		<script  type="text/javascript" src="https://js.stripe.com/v3/"></script>
			
		@endpush
@endsection