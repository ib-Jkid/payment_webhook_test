
<form >
  <script src="https://js.paystack.co/v1/inline.js"></script>

</form>

<script>
  function payWithPaystack(){
    var handler = PaystackPop.setup({
      key: `{{ env('PAYSTACK_PUBLIC_KEY') }}`,
      email: '{{$user->email}}',
      amount: '{{ ($transaction->total_amount + $transaction->gateway_charges) * 100 }}',
      currency: "NGN",
      ref: '{{$transaction->reference}}', // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    
      callback: function(response){

        var link = document.createElement('a');
        link.href = `{{ route('payment.verify', $transaction->reference ) }}`;
        document.body.appendChild(link);
        link.click(); 
         
      },
      onClose: function(){
        var link = document.createElement('a');
        link.href = `{{ route('payment') }}`;
        document.body.appendChild(link);
        link.click(); 
      }
    });
    handler.openIframe();
  }

  payWithPaystack();
</script>