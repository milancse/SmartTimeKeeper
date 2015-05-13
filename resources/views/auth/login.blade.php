<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>SmartTimeKeeper| Log in</title>
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
            <div class="header"><strong>Welcome Back!</strong></div>
            <!-- check for login error flash var -->
            {!! Form::open(array('url' => 'auth/login')) !!}
            <div class="body bg-gray">
                {!! Session::get('flash_message') !!}
                <div class="form-group">
                    {!! Form::email('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>'E-Mail Address')) !!}
                    <?php echo $errors->first('email'); ?>
                </div>
                <div class="form-group">
                    {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password'), Input::old('password')) !!}
                    <?php echo $errors->first('password'); ?>
                </div>          
                <div class="form-group">
                    {!! Form::checkbox('remember') !!} Remember me
                </div>
            </div>
            <div class="footer">    
                {!! Form::submit('Sign me in', array('class'=>'btn bg-olive btn-block')) !!}

                <p><a href="{{URL::to('password/forgot-password')}}">I forgot my password</a></p>

                <!-- <a href="register.html" class="text-center">Register a new membership</a> -->
            </div>
            {!! Form::close() !!}

            <!--            <div class="margin text-center">
                            <span>Sign in using social networks</span>
                            <br/>
                            <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                            <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                            <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>
            
                        </div>-->
        </div>

        <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
		<script src="{{ URL::asset('bootstrap-3.3.4/js/bootstrap.min.js') }}" type="text/javascript"></script>

    </body>
</html>