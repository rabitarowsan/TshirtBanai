@extends('layout')

@section('title', 'T-Shirt Banai - Sign Up')
<style>
	html,
	body {
		height: 100%;
	}

	body {
		display: -ms-flexbox;
		display: -webkit-box;
		display: flex;
		-ms-flex-align: center;
		-ms-flex-pack: center;
		-webkit-box-align: center;
		align-items: center;
		-webkit-box-pack: center;
		justify-content: center;
		background-color: #f5f5f5;
	}

	form {
		padding-top: 10px;
		font-size: 14px;
		margin-top: 30px;
	}

	.card-title {
		font-weight: 300;
	}

	.btn {
		font-size: 14px;
		margin-top: 20px;
	}

	.login-form {
		width: 320px;
		margin: 20px;
	}

	.sign-up {
		text-align: center;
		padding: 20px 0 0;
	}

	span {
		font-size: 14px;
	}
</style>
@section('content')
<div class="card login-form">
	<div class="card-body">
		<form action="{{ route('reset.password.post', ['token' => $token]) }}" method="POST">
			@csrf
			<input type="text" name="token" hidden value="{{$token}}">
			<h3 class="card-title text-center">Reset password</h3>

			<div class="card-text">

				<div class="form-group">
					<input type="email" class="form-control form-control-sm" name="email" placeholder="Enter your email address">
					<input type="password" class="form-control form-control-sm" name="password" placeholder="Enter your new password">
					<input type="password" class="form-control form-control-sm" name="password_confirmation" placeholder="Confirm your new password">
				</div>

				<button type="submit" class="btn btn-primary btn-block">Send password reset email</button>
		</form>
	</div>
</div>
</div>
@endsection