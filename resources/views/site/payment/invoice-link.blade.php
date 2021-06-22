@extends('site.layouts.app')

@section('content')
    	<!-- #masthead -->
		<div id="content" class="site-content">
			<div id="primary" class="content-area column full">
				<main id="main" class="site-main">
				<article id="post-39" class="post-39 page type-page status-publish hentry">
				<header class="entry-header">
				<h1 class="entry-title">Invoice Link Page</h1>
				</header>
				<!-- .entry-header -->
				<div class="entry-content">
					<div class="">
						<h4>InvoiceLink</h4>						
						<div>								
                            "Click on <a href='{{ $paymentLink }}' target='_blank'>{{ $paymentLink }}</a> to pay with invoiceID {{ $invoiceId }}."
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