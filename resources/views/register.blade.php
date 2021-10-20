@extends("layouts.app")
@section("content")
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @include("includes.navbar")

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8" >
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <div id="register">
              
                    <div class="container">
                        <div id="login-row" class="row justify-content-center align-items-center">
                            <div id="login-column" class="col-12">
                                <div id="login-box" class="col-12">
                                    <form  id="login-form" class="form" action="{{ route('register') }}" method="post">
                                        @csrf
                                        <h3 class="text-center text-info">Register</h3>
                                        <div class="form-group">
                                            <label for="name" class="text-info">Name:</label><br>
                                            <input type="text" name="name" id="name" class="form-control">
                                            @include("includes.form_error",["name" => "name"])
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="text-info">Email:</label><br>
                                            <input type="email" name="email" id="email" class="form-control">
                                            @include("includes.form_error",["name" => "email"])
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="text-info">Password:</label><br>
                                            <input type="password" name="password" id="password" class="form-control">
                                            @include("includes.form_error",["name" => "password"])
                                        </div>
                                        <div class="form-group">
                                            <label for="password-confirmation" class="text-info">Confirm Password:</label><br>
                                            <input type="password" name="password_confirmation" id="password-confirmation" class="form-control">
                                            @include("includes.form_error",["name" => "password-confirmation"])
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                                        </div>
                                      
                                        <div id="login-link" class="text-right">
                                            <a href="{{ route('login') }}" class="text-info">Login here</a>
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
