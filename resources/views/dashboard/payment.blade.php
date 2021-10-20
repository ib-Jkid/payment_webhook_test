@extends("layouts.app")
@section("content")
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @include("includes.navbar")

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    
                 
                <div id="login">
              
                    <div class="container">
                        <div id="login-row" class="row justify-content-center align-items-center">
                            <div id="login-column" class="col-md-12">
                                <div id="login-box" class="col-md-12">
                                    <form id="login-form" class="form" action="{{ route('payment.initiate') }}" method="post">
                                        @csrf
                                        <h3 class="text-center text-info">Make Payment</h3>
                                        <p>Enter the amount you wish to pay</p>
                                        <div class="form-group">
                                            <label for="amount" class="text-info">Amount:</label><br>
                                            <input type="text" name="amount" id="amount" class="form-control">
                                            @include("includes.form_error",["name" => "amount"])
                                        </div>

                                        <div class="form-group">
                                            <label for="currency" class="text-info">Currency:</label><br>
                                            <select name="currency" id="currency" class="form-control">
                                                <option value="">Select Currency</option>
                                                <option value="NGN">NGN</option>
                                            </select>
                                            @include("includes.form_error",["name" => "currency"])
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit" class="btn btn-info btn-md" value="Pay">
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
