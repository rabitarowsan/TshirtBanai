@extends('layout')

@section('title', 'T-Shirt Banai - Authentication')

@section('content')
<link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
<div class='box'>
  <form action="{{route('login.post')}}" method="POST">
    @csrf
  <div class='box-form'>
    <div class='box-login-tab'></div>
    <div class='box-login-title'>
      <div class='i i-login'></div><h2>LOGIN</h2>
    </div>
    <div class='box-login'>
      <div class='fieldset-body' id='login_form'>
        <button onclick="openLoginInfo();" class='b b-form i i-more' title='Mais Informações'></button>
        	<p class='field'>
          <label class = "form-control"for='user'>E-MAIL</label>
          <input type='email' class ='form-control' id='user' name='email' title='Username' />
          <span id='valida' class='i i-warning'></span>
        </p>
      	  <p class='field'>
          <label class = "form-control" for='pass'>PASSWORD</label>
          <input type='password' class ='form-control' id='pass' name='password' title='Password' />
          <span id='valida' class='i i-close'></span>
        </p>

          <label class='checkbox'>
            <input type='checkbox' value='TRUE' title='Keep me Signed in' /> Keep me Signed in
          </label>

        	<button type='submit' class='b-cta' id='do_login' value='GET STARTED' title='Get Started'>Log In</button>
      </div>
    </div>
  </div>
  <div class='box-info'>
					    <p><button onclick="closeLoginInfo();" class='b b-info i i-left' title='Back to Sign In'></button><h3>Need Help?</h3>
    </p>
					    <div class='line-wh'></div>
    					<button onclick="" class='b-support' title='Forgot Password?'> <a href="{{route('forgot.password')}}">Forget Password?</a></button>
    <button onclick="" class='b-support' title='Contact Support'> Contact Support</button>
    					<div class='line-wh'></div>
              Do not have an account?
              <div class='line-wh'></div>
              <button onclick="" class='b-cta' title='Sign in now!'> <a href="{{route('register')}}">Create Account</a></button>  				</div>
    </form>
</div>

@endsection
<script src="{{ asset('assets/js/login.js') }}"></script>