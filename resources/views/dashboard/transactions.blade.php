@extends("layouts.app")
@section("content")
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @include("includes.navbar")

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                  
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr class="table-head">
                                <th>Reference</th>
                                <th>Amount</th>
                                <th>Charges</th>
                                <th>Status</th>
                                <th>Paid</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <th>{{$transaction->reference}}</th>
                                    <th>{{number_format($transaction->total_amount)}}</th>
                                    <th>{{ number_format($transaction->gateway_charges) }} </th>
                                    <th>{{ $transaction->status }}</th>
                                    <th>{{ $transaction->paid_on }}</th>
                                    <th>{{ $transaction->created_at }}</th>
                                    <th><a href="#"  class="btn btn-info btn-md" >Details</a></th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                      
                    </div>
                   
                 
               
         
                </div>
                {{$transactions->links()}}


            </div>
        </div>
@endsection
