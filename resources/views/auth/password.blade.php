<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>PatientDB | Reset Password</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="{{ URL::asset('bootstrap-3.3.4/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="{{ URL::asset('css/font-awesome-4.3.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{ URL::asset('css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
        <div class="form-box" id="login-box">
            <div class="header"><strong>Reset Password</strong></div>
            <!-- check for login error flash var -->
            {!! Form::open(array('url' => 'password/email')) !!}
            <div class="body bg-gray">
            	@if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
				@endif

				@if (count($errors) > 0)
					<div class="alert alert-danger">
						@foreach ($errors->all() as $error)
						<p>{{ $error }}</p>
						@endforeach
					</div>
				@endif
                <div class="form-group">
                	{!! Form::label('email', 'E-Mail Address')!!}
                    {!! Form::email('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>'Email')) !!}
                </div>
            </div>
            <div class="footer">    
                {!! Form::submit('Send Password Reset Link', array('class'=>'btn bg-olive btn-block')) !!}
				<p><a href="{{URL::to('auth/login')}}"> back to login</a></p>
            </div>
            {!! Form::close() !!}
        </div>

        <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
		<script src="{{ URL::asset('bootstrap-3.3.4/js/bootstrap.min.js') }}" type="text/javascript"></script>

    </body>
</html>