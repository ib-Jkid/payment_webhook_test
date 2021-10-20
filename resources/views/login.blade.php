@extends("layouts.app")
@section("content")
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @include("includes.navbar")

            <div class="max-w-12xl mx-auto sm:px-12 lg:px-12">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <div id="login">
              
                    <div class="container">
                        <div id="login-row" class="row justify-content-center align-items-center">
                            <div id="login-column" class="col-md-12">
                                <div id="login-box" class="col-md-12">
                                    <form id="login-form" class="form" action="{{ route('login') }}" method="post">
                                        @csrf
                                        <h3 class="text-center text-info">Login</h3>
                                        <div class="form-group">
                                            <label for="email" class="text-info">Email:</label><br>
                                            <input type="text" name="email" id="email" class="form-control">
                                            @include("includes.form_error",["name" => "email"])
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="text-info">Password:</label><br>
                                            <input type="password" name="password" id="password" class="form-control">
                                            @include("includes.form_error",["name" => "password"])
                                        </div>
                                        <div class="form-group">
                                            <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember" type="checkbox"></span></label><br>
                                            <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                                      
                                        </div>
                                        <div id="register-link" class="text-right">
                                            <a href="{{ route('register') }}" class="text-info">Register here</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 
               
         
                </div>


            </div>
            </div>
@endsection
