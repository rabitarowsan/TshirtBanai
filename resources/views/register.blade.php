@extends('layout')

@section('title', 'T-Shirt Banai - Sign Up')
<link href="{{ asset('assets/css/register.css') }}" rel="stylesheet">
@section('content')

<div class='box'>
  <form action="{{route('register.post')}}" method="POST">
    @csrf
  <div class='box-form'>
    <div class='box-login-tab'></div>
    <div class='box-login-title'>
      <div class='i i-login'></div><h2>SIGNUP</h2>
    </div>
    <div class='box-login'>
      <div class='fieldset-body' id='login_form'>
        <button onclick="openLoginInfo();" class='b b-form i i-more' title='Mais Informações'></button>
        	<p class='field'>
          <label class = "form-label">Name</label>
          <input type='text' class = "form-control" name='name'/>
          <span id='valida' class='i i-warning'></span>
        </p>
        	<p class='field'>
          <label class = "form-label" >E-MAIL</label>
          <input class = "form-control" type='email' name='email'/>
          <span id='valida' class='i i-warning'></span>
        </p>
      	  <p class='field'>
          <label class = "form-label">PASSWORD</label>
          <input class = "form-control" type='password' name='password'/>
          <span id='valida' class='i i-close'></span>
        </p>

          

        	<button type='submit' class = 'b-cta'> Create Account</button>
      </div>
    </div>
  </div>
  <div class='box-info'>
					    <p><button onclick="closeLoginInfo();" class='b b-info i i-left' title='Back to Sign In'></button><h3>Need Help?</h3>
    </p>
					    <div class='line-wh'></div>
    					
    <button onclick="" class='b-support' title='Contact Support'> Contact Support</button>
    					<div class='line-wh'></div>
              <h3>Already registered?</h3>
              <div class='line-wh'></div>
    <button onclick="" class='b-cta' title='Sign in now!'> <a href="{{route('login')}}">Log In</a></button>
  				</div>
          </form>
</div>

@endsection
<script src="{{ asset('assets/js/register.js') }}"></script>