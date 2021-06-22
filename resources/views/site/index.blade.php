@extends('site.layouts.app')

@section('content')
    <!-- #masthead -->
		<div id="content" class="site-content">
			<div id="primary" class="content-area column full"> 
				<main id="main" class="site-main">
                    <div class="grid portfoliogrid">
                    
                        @foreach ($categories as $category)
                            <article class="hentry " >
                                <header class="entry-header">
                                    <div class="entry-thumbnail">
                                        <a href="{{ route( 'site.showCategory' , $category->id ) }}" >
                                            <img src="{{ get_image('categories',$category->photo) }}" 
                                            class="attachment-post-thumbnail size-post-thumbnail wp-post-image" 
                                            alt="p1"/>
                                        </a>
                                    </div>
                                    <h2 class="entry-title"><a href="{{ route( 'site.showCategory' , $category->id ) }}"  rel="bookmark">{{ $category->name }}</a></h2>
                                    <a class='portfoliotype' href="{{ route( 'site.showCategory' , $category->id ) }}" >Description goes here</a>
                                    
                                </header>
                            </article>
                        @endforeach
                        
                       
                        
                    </div>
                    <!-- .grid -->
{{--                     
                    <nav class="pagination">
                        <span class="page-numbers current">1</span>
                        <a class="page-numbers" href="#">2</a>
                        <a class="next page-numbers" href="#">Next »</a>
                    </nav> --}}
                    <br/>
                    
				</main>
				<!-- #main -->
			</div>
			<!-- #primary -->
		</div>
		<!-- #content -->
@endsection