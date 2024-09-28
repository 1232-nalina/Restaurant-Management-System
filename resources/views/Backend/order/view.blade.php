@extends('Backend.dashboard.main')
@section('title', 'Order View')
@section('content')
    @php
        $whouser = Auth::guard('admin')->user();
    @endphp
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Today's Orders <i class="fa fa-coffee "></i></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('order.view') }}">Order</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">View</a></li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="card bg-white">
            <div class="card-header">
                <h5 class="">Today's Order Status - {{ date('Y-M-d') }}</h5>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-solid nav-justified">
                    <li class="nav-item"><a class="nav-link active" href="#solid-justified-tab1"
                            data-bs-toggle="tab">Pending Orders <span class="badge badge-danger">{{ count($pendingorders) }}
                                orders</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#solid-justified-tab2" data-bs-toggle="tab">Orders
                            Completed <span class="badge badge-success">{{ count($completedorders) }} orders</span></a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="#solid-justified-tab3" data-bs-toggle="tab">Messages</a></li> --}}
                </ul>
                <div class="tab-content">
                    @include('Backend.order.pending-modal-tab')
                    @include('Backend.order.completed-modal-tab')


                    {{-- <div class="tab-pane" id="solid-justified-tab3">
            Tab content 3
            </div> --}}
                </div>
            </div>
        </div>

        @foreach ($pendingorders as $value)
            <div class="modal fade" id="paymentModal-{{ $value->id }}" tabindex="-1"
                aria-labelledby="paymentModalLabel-{{ $value->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentModalLabel-{{ $value->id }}">Payment Details</h5>

                            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="bg-info text-center text-white">
                            <i class="mdi mdi-alert"></i> Leave the discount field empty if no discount available
                        </div>
                        <div class="modal-body">
                            <form id="paymentForm-{{ $value->id }}">

                                <input type="hidden" value="{{ $value->id }}" name="order_id">

                                <div class="form-group">
                                    <label for="paymentType-{{ $value->id }}">Payment Type</label>
                                    <select class="form-control" id="paymentType-{{ $value->id }}" name="paymentType">
                                        <option value="cash">Cash</option>
                                        <option value="phonepay">PhonePay</option>
                                        <option value="esewa">Esewa</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Toal Amount</label>
                                            <input type="text" class="form-control" name="amount"
                                                value="{{ $value->total }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Discount (%)</label>
                                            <input type="number" class="form-control" id="discount-{{ $value->id }}"
                                                name="discount">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">After Discount</label>
                                            <input type="number" class="form-control"
                                                id="afterdiscount-{{ $value->id }}" name="afterdiscount" readonly>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cashAmount-{{ $value->id }}">Cash Amount</label>
                                            <input type="number" class="form-control" id="cashAmount-{{ $value->id }}"
                                                name="cashAmount" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="changeAmount-{{ $value->id }}"> Change Amount</label>
                                            <input type="text" class="form-control"
                                                id="changeAmount-{{ $value->id }}" name="changeAmount" readonly>
                                        </div>
                                    </div>
                                </div>


                                <a class="btn btn-primary btn-sm text-center mt-2"
                                    id="makePaymentBtn-{{ $value->id }}">Make Payment</a>
                            </form>

                            {{-- receipt  --}}

                            <div id="receipt-{{ $value->id }}" class="receipt" style="display: none">
                                <div class="ticket centered">
                                    {{-- <img src="./logo.png" alt="Logo"> --}}
                                    <p class="centered" id="my-pad-bot"><b>{{ config('app.name') }}</b>
                                        <br>Satdobato,lalitpur
                                    </p>

                                    <table class="my-pad-30">
                                        <thead>
                                            <tr>

                                                <th class="description left">Items</th>
                                                <th class="quantity left">Quantity</th>
                                                <th class="description left">Per unit</th>
                                                <th class="price left">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($value->orderItems as $item)
                                                <tr>
                                                    <td class="description">{{ $item->menuItem->name }}</td>
                                                    <td class="quantity">{{ $item->quantity }}</td>
                                                    <td class="description">{{ $item->menuItem->price }}</td>
                                                    <td class="price">{{ $item->menuItem->price * $item->quantity }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <span class="float-end">Sub Total: <b class="orderTotal-{{ $value->id }}"></b>
                                    </span> <br>

                                    <div class="dis-amount-percentage-{{$value->id}}">
                                        <span class="float-end"> Discount<span>(<span class="discountPercentage-{{ $value->id }}"></span>):</span> <b class="discountAmount-{{ $value->id }}"></b>
                                    </span><br>
                                   <span class="float-end">Grand Total: <b class="receiptTotal-{{ $value->id }}"></b>
                                  </span>

                                    <br>
                                    </div>

                                    <p class="centered">** Thanks for coming **
                                        <br>** Please visit again **
                                    </p>
                                </div>
                                <button id="btnPrint{{ $value->id }}"
                                    class="hidden-print btn btn-success btn-sm">Print Receipt</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


    @endsection

    @section('scripts')

        <script>
            @foreach ($pendingorders as $value)
                $(document).ready(function() {
                    function calculateChangeAmount() {
                        var paymentType = $('#paymentType-{{ $value->id }}').val();
                        var cashAmount = parseFloat($('#cashAmount-{{ $value->id }}').val());
                        var orderTotal = parseFloat('{{ $value->total }}');
                        var afterDiscountValue = parseFloat($('#afterdiscount-{{ $value->id }}').val());

                        var changeAmount;

                        if (paymentType === 'cash') {
                            if (isNaN(afterDiscountValue)) {
                                // Calculate change amount without discount
                                changeAmount = cashAmount - orderTotal;
                            } else {
                                // Calculate change amount with discount
                                changeAmount = cashAmount - afterDiscountValue;
                            }
                            $('#changeAmount-{{ $value->id }}').val(changeAmount.toFixed(2));
                        } else {
                            $('#changeAmount-{{ $value->id }}').val('');
                        }
                    }

                    $('#discount-{{ $value->id }}').on('keyup', function() {
                        var discountPercentage = parseFloat($('input[name="discount"]').val());
                        var orderTotal = parseFloat('{{ $value->total }}');
                        var discountAmount = orderTotal * (discountPercentage / 100);
                        var newTotal = orderTotal - discountAmount;
                        $('#afterdiscount-{{ $value->id }}').val(newTotal);

                        // Update the change amount when the discount is updated
                        calculateChangeAmount();
                    });

                    $('#cashAmount-{{ $value->id }}').on('keyup', function() {
                        // Update the change amount when the cash amount is updated
                        calculateChangeAmount();
                    });

                    $('#paymentForm-{{ $value->id }}').on('submit', function(e) {
                        e.preventDefault();

                        // Add your logic for submitting the payment
                    });

                    // Reset form on X button click
                    $('.modal-close').on('click', function() {
                        $('#paymentForm-{{ $value->id }}').trigger('reset');
                    });
                });
            @endforeach
        </script>


        <script>
            $(document).ready(function() {

                @foreach ($pendingorders as $value)
                    $('#makePaymentBtn-{{ $value->id }}').on('click', function(e) {
                        e.preventDefault();
                        //alert('ok');

                        // Get the payment data from the form fields
                        var paymentType = $('#paymentType-{{ $value->id }}').val();
                        var cashAmount = parseFloat($('#cashAmount-{{ $value->id }}').val());
                        if (isNaN(cashAmount)) {
                            Swal.fire({
                                title: "Enter A Cash Amount",
                                text: "Cash Amount Shouldnot be Blank",
                                type: "error",
                                showCancelButton: 0,
                                confirmButtonColor: "#3085d6",

                                confirmButtonText: "Ok",
                                confirmButtonClass: "btn btn-primary",

                            });
                            return;
                        }
                        var changeAmount = parseFloat($('#changeAmount-{{ $value->id }}').val());

                        // Create the AJAX request
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            type: 'POST',
                            url: '{{ route('payment.store') }}',
                            data: {
                                paymentType: paymentType,
                                cashAmount: cashAmount,
                                changeAmount: changeAmount,
                                orderId: {{ $value->id }},
                                amount: {{ $value->total }},
                                table_id: {{ $value->table->id }},
                            },
                            beforeSend: function() {
                                // Show a spinner or loading state
                                // You can display a spinner or loading message here to indicate the payment is being processed
                            },
                            success: function(response) {
                                // Handle the success response
                                // You can display a success message or perform any necessary actions after successful payment
                                console.log('Payment successful:', response);

                                // Hide the payment form
                                $('#paymentForm-{{ $value->id }}').hide();


                                Swal.fire({
                                    title: "Payment Made Successfully",
                                    text: "Click on ok to see and print the receipt ",
                                    type: "success",
                                    showCancelButton: 0,
                                    confirmButtonColor: "#3085d6",

                                    confirmButtonText: "Ok",
                                    confirmButtonClass: "btn btn-primary",

                                })
                                // Set payment details in receipt
                                $('#receiptPaymentType-{{ $value->id }}').text(paymentType);
                                $('#receiptCashAmount-{{ $value->id }}').text(cashAmount
                                    .toFixed(2));
                                $('#receiptChangeAmount-{{ $value->id }}').text(changeAmount
                                    .toFixed(2));


                                // Calculate the receipt total with or without discount
                                var discountPercentage = parseFloat($(
                                    '#discount-{{ $value->id }}').val());
                                var orderTotal = parseFloat('{{ $value->total }}');
                                var discountAmount = orderTotal * (discountPercentage / 100);
                                var newTotal = orderTotal - discountAmount;
                                var receiptTotal = isNaN(newTotal) ? orderTotal : newTotal;
                                $('.receiptTotal-{{ $value->id }}').text(receiptTotal.toFixed(
                                    2));
                                $('.orderTotal-{{ $value->id }}').text(orderTotal);
                                $('.discountAmount-{{ $value->id }}').text(discountAmount);
                                $('.discountPercentage-{{ $value->id }}').text(discountPercentage + '%');

                                if(isNaN(discountPercentage))
                                {
                                    $('.dis-amount-percentage-{{$value->id}}').hide();
                                }

                                $('#receipt-{{ $value->id }}').show();
                                // Show the receipt


                                // close modal on X button click
                                $('.modal-close').on('click', function() {
                                    $('#paymentForm-{{ $value->id }}').modal('hide');
                                    location.reload();
                                });

                            },

                            error: function(xhr, status, error) {
                                // Handle the error response
                                // You can display an error message or perform any necessary actions if the payment fails
                                console.log('Payment error:', xhr.responseText);
                            },
                            complete: function() {
                                // Hide the spinner or loading state
                                // You can hide the spinner or loading message here after the payment request is complete
                            }

                        });
                    });
                    const $btnPrint{{ $value->id }} = document.querySelector("#btnPrint{{ $value->id }}");
                    $btnPrint{{ $value->id }}.addEventListener("click", () => {
                        const content = document.querySelector("#receipt-{{ $value->id }}").innerHTML;
                        const printWindow = window.open('', '', 'height=600,width=800');
                        printWindow.document.write('<html><head><title>Receipt Example</title>');
                        printWindow.document.write(
                            '<style>.hidden-print { display: none; } #my-pad-bot{ padding-bottom:5px }.float-end{ float:right; font-size:12px; margin-top:5px; margin-right:50px;} .left{padding-right:40px} .description{font-size:12px} .quantity{font-size:12px} .price{font-size:12px} .my-pad-30{ padding-top:30px; } table{ width:100%; border-collapse: collapse; } td { border-bottom: 1px solid #ccc; padding: 5px; } .centered {text-align: center!important;align-content: center!important;}</style>'
                            );
                        printWindow.document.write('</head><body>');
                        printWindow.document.write(content);
                        printWindow.document.write('</body></html>');
                        printWindow.document.close();
                        printWindow.focus();
                        printWindow.print();
                        printWindow.close();
                        location.reload();
                        $("#receiptModalCompleted-{{ $value->id }}").modal('hide');


                    });
                @endforeach
            });
        </script>

        {{-- for completed orders --}}
        <script>
            $(document).ready(function() {
                @foreach ($completedorders as $value)
                    const $btnPrint{{ $value->id }} = document.querySelector("#btnPrint{{ $value->id }}");
                    $btnPrint{{ $value->id }}.addEventListener("click", () => {
                        const content = document.querySelector("#receiptModalCompleted-{{ $value->id }}")
                            .innerHTML;
                        const printWindow = window.open('', '', 'height=600,width=800');
                        printWindow.document.write('<html><head><title>Receipt Example</title>');
                        printWindow.document.write(
                            '<style>.hidden-print { display: none; } #my-pad-bot{ padding-bottom:5px }.float-end{ float:right; font-size:12px; margin-top:5px; margin-right:50px;} .left{padding-right:40px} .description{font-size:12px} .quantity{font-size:12px} .price{font-size:12px} .my-pad-30{ padding-top:30px; } table{ width:100%; border-collapse: collapse; } td { border-bottom: 1px solid #ccc; padding: 5px; } .centered {text-align: center!important;align-content: center!important;}</style>'
                            );
                        printWindow.document.write('</head><body>');
                        printWindow.document.write(content);
                        printWindow.document.write('</body></html>');
                        printWindow.document.close();
                        printWindow.focus();
                        printWindow.print();
                        printWindow.close();
                        $("#receiptModalCompleted-{{ $value->id }}").modal('hide');


                    });
                @endforeach
            });
        </script>



    @endsection


    <style>
        .receipt td,
        th,
        tr,
        table {
            width: 100%;
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        .receipt td.description,
        th.description {
            width: 75px;
            max-width: 75px;
        }

        .receipt td.quantity,
        th.quantity {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        .receipt td.price,
        th.price {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        .receipt .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 100%;
            max-width: 100%;
        }



        @media print {

            .btnPrint,
            .btnPrint * {
                display: none !important;
            }
        }
    </style>
