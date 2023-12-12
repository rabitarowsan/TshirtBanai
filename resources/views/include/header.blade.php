<nav class="uk-navbar-container uk-margin" uk-navbar>

  <div class="nav-overlay uk-navbar-left">

    <a href="{{route('home')}}">{{config('app.name')}}</a>

    <ul class="uk-navbar-nav">
      <li class="uk-active"><a href="{{route('customize')}}">Customize T-Shirt</a></li>
  </div>

  <div class="nav-overlay uk-navbar-right">
  <ul class="uk-navbar-nav">
  @auth
      <li><a href="{{route('logout')}}">Logout</a></li>
      @else
      <li><a href="{{route('login')}}">Login</a></li>
      <li><a href="{{route('register')}}">Register</a></li>
      @endauth
    </ul>
    <span>@auth{{auth()->user()->name}}@endauth</span>
  </div>

  

</nav>