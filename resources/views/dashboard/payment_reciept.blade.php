@extends("layouts.app")
@section("content")
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @include("includes.navbar")

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
              
                    <div class="card">
                        <h2 class="card-header text-center">RECEIPT</h2>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Reference:</th>
                                    <td>{{$transaction->reference}}</td>
                                </tr>
                                <tr>
                                    <th>Amount:</th>
                                    <td>{{ $transaction->currency }} {{ number_format($transaction->total_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Charges:</th>
                                    <td>{{ $transaction->currency }} {{ number_format($transaction->gateway_charges, 2) }}</td>
                                </tr>


                                <tr>
                                    <th>Status</th>
                                    <td>{{ $transaction->status }}</td>
                                </tr>

                                <tr>
                                    <th>Paid</th>
                                    <td>{{ Carbon\Carbon::parse($transaction->paid_on)->toDateTimeString() }}</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                 
               
         
                </div>


            </div>
        </div>
@endsection
