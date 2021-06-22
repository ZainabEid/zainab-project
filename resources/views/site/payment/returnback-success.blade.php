@extends('site.layouts.app')

@section('content')
    	<!-- #masthead -->
		<div id="content" class="site-content">
			<div id="primary" class="content-area column column-third">
				<main id="main" class="site-main">
				<article id="post-39" class="post-39 page type-page status-publish hentry">
				<header class="entry-header">
				<h1 class="entry-title">Return Back succeeded page </h1>
				</header>
				<!-- .entry-header -->
				<div class="entry-content">
					<div class="">
						<h4><strong>Your payment succeeded, Thank you!</strong></h4>	
                        <a href="{{ route('site.shop') }}">Continue Shopping</a>
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