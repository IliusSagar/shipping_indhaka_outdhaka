<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
</head>
<body>
@php
    $totalcalulation = 0;
    $productamount = 0;
    $shipping = DB::table('shipping_charges')->first();
    $total = 0;
@endphp

<div class="header">
    <h4>Shipping</h4>
</div>
<div class="form-group">
    <ul>
        <input type="text" name="shipping_charge" value="{{ $shipping->outside_dhaka }}">
        <hr>
        <input type="radio" class="click-able shipping_charge" name="shipping" value="{{ $shipping->outside_dhaka }}" id="outsideDhakaRadio" checked>
        Outside Dhaka
    </ul>
    <ul>
        <input type="radio" class="click-able shipping_charge" name="shipping" value="{{ $shipping->inside_dhaka }}" id="insideDhakaRadio">
        Inside Dhaka
    </ul>
</div>

<div class="col-md-4">
    <h6><b>Total:</b></h6>
    <br>
    <h6><b>Shipping Charge</b></h6>
</div>
<div class="col-md-4"></div>
<div class="col-md-4">
    <p id="product_amount">
        <span>&nbsp;</span>
        ৳ {{ $totalcalulation }}
    </p>
    <br>
    <p class="shipping_charge">
        <span>&nbsp;</span>
        ৳ {{ $shipping->outside_dhaka }}
    </p>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      
        $('input[type=radio][name=shipping]').change(function() {
            var shippingCharge = $(this).val();
            var productAmount = parseFloat($('#product_amount').text().replace('৳', '').trim());
            $.ajax({
                type: "POST",
                url: "{{ route('updateTotal') }}",
                data: {
                    shippingCharge: shippingCharge,
                    productAmount: productAmount,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('input[name="shipping_charge"]').val(response.shippingCharge);
                    $('.shipping_charge').text('৳' + response.shippingCharge);
                    $('.payable_amount').text('৳' + response.paybleAmount);
                },
                error: function(xhr, status, error) {
                    console.error(error); // Log any errors
                }
            });
        });
    });
</script>
</body>
</html>