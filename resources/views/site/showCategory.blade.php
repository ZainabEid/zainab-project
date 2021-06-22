@extends('site.layouts.app')

@section('content')
    <!-- #masthead -->
	<div id="content" class="site-content">
		<div id="primary" class="content-area column full">
			<main id="main" class="site-main" role="main">

						<header class="page-header">
							<h3 class="page-title">
                                {{ $category->name }}
							</h3>
						</header>

							<ul class="products">
								@foreach ($category->products as $product)

								@include('site.includes._product_list_item')
	
								
								@endforeach
	
							</ul>
							

						

						<nav class="pagination">
							<span class="page-numbers current">1</span>
							<a class="page-numbers" href="#">2</a>
							<a class="next page-numbers" href="#">Next »</a>
						</nav>
						<br />

					</main>
					<!-- #main -->
				</div>
				<!-- #primary -->
			</div>
			<!-- #content -->
@endsection