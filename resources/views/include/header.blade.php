<nav class="uk-navbar-container uk-margin" uk-navbar>

  <div class="nav-overlay uk-navbar-left">

    <a href="#">{{config('app.name')}}</a>

    <ul class="uk-navbar-nav">
      <li class="uk-active"><a href="#">Active</a></li>
      <li><a href="#">Item</a></li>
      @auth
      <li><a href="{{route('logout')}}">Logout</a></li>
      @else
      <li><a href="{{route('login')}}">Login</a></li>
      <li><a href="{{route('register')}}">Register</a></li>
      @endauth
    </ul>
    <span>@auth{{auth()->user()->name}}@endauth</span>
    
  </div>

  <div class="nav-overlay uk-navbar-right">

    <a class="uk-navbar-toggle" uk-search-icon="ratio: 2" uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#"></a>

  </div>

  <div class="nav-overlay uk-navbar-left uk-flex-1" hidden>

    <div class="uk-navbar-item uk-width-expand">
      <form class="uk-search uk-search-navbar uk-width-1-1">
        <input class="uk-search-input" type="search" placeholder="Search..." autofocus>
      </form>
    </div>

    <a class="uk-navbar-toggle" uk-close uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#"></a>

  </div>

</nav>