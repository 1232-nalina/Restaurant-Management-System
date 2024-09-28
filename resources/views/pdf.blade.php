<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


    <title>
        Payment Ticket
    </title>
    <style>
        html,
        body {
            font-family: 'Nunito', sans-serif;
            margin-left: 6px;
            margin-right: 2px;
            margin-bottom: 2px;
            margin-top: 2px;
        }

        .container {
            width: 141px;
            margin: 0px 16px;

        }

        /* @page {
            margin-left:0px;
            margin-right:0px;
            margin-bottom:0px;
            margin-top:0px;
        } */

        .ticket-header {
            text-align: center;
        }

        .table-data {
            text-align: center;
        }

        .border1 {
            border-top: 1px solid black;
        }

        .border2 {
            border-bottom: 1px solid black;
        }

        .new1 {
            border: 1px dashed #000;
            width: 100%;
        }

        .ticket-para {
            font-size: 7px;
            margin: 0;
            margin-top: 0.2rem;
        }

        .table-title {
            font-size: 8px
        }

        .inv-div {
            float: left;
        }

        .qr-div {
            float: right;
        }

        .ticket-para-rate {
            font-size: 14px;
        }

        .container-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .page-break-after {
    page-break-after: always;
}
    </style>
</head>

<body>
    {{-- @dd($data) --}}
    <div >
        <h3>Order Details</h3>
        <p>Order no: {{ $data['order']->id }}</p>
        <p>Table no: {{ $data['order']->table_id }}</p>
        {{-- <p>Status: {{ $order->status }}</p> --}}
        {{-- <p>Total: {{ $order->total }}</p> --}}
    </div>


    <h4>Ordered Items:</h4>
    <ul >
        @foreach ($data['orderItems'] as $orderItem)
    {{-- @dd($orderItem) --}}

        <p>Kitchen no: {{ $orderItem->kitchen_id }}</p>

            <li style="margin-top:-30px; ">
                <p>Menu Item: {{ $orderItem->menuItem->name }}</p>
                <p style="margin-top: -10px;">Quantity: {{ $orderItem->quantity }}</p>
                {{-- <p>Price: {{ $orderItem->price }}</p> --}}
                {{-- <p>Ingredients:</p>
                <ul>
                    @foreach ($orderItem->menu_item->ingredients as $ingredient)
                        <li>{{ $ingredient->name }} - {{ $ingredient->quantity }} {{ $ingredient->unit }}</li>
                    @endforeach
                </ul> --}}
            </li>
        @endforeach
    </ul>
</body>
</html>

{{-- <script>
        // Use JavaScript to open the PDF in a new window or tab
        var pdfUrl = "{{ $pdf_url }}";
        window.open(pdfUrl, '_blank');
    </script> --}}
