<header id="masthead" class="site-header">

    <div class="site-branding">
        <h1 class="site-title"><a href="index.html" rel="home">Zainab Project</a></h1>
        <h2 class="site-description">Category Products Shopping Website</h2>
    </div>

    <nav id="site-navigation" class="main-navigation">
        <button class="menu-toggle">Menu</button>
        <a class="skip-link screen-reader-text" href="#content">Skip to content</a>
        <div class="menu-menu-1-container collapse navbar-collapse">
            
            <ul id="menu-menu-1" class="menu">

                <li><a href="{{ route('site.index') }}">Home</a></li>
                <li><a href="{{ route('site.shop') }}">Shop</a></li>
                <li><a href="{{ route('site.cart') }}">cart</a></li>


                    {{-- authentication links --}}
                    @if (Auth::guard('web')->guest())
   
   
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
   
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
    
    
                @else
                    <li class="nav-item dropdown ">
                        
                        {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>     --}}
        
                        {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" > --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
        
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        {{-- </div> --}}
                    </li>
                @endif


            </ul>


            

            
        </div>
    </nav>
</header>

