<div class="tab-pane " id="solid-justified-tab2">
    <div class="row">

        @if ($completedorders)
            @foreach ($completedorders as $key => $value)
                <div class="col-sm-6 col-lg-4 col-xl-4 col-md-4 d-flex">
                    <div class="card invoices-grid-card w-100">
                        <div class="card-header d-flex justify-content-between align-items-center"
                            style="padding: 0">
                        </div>
                        <div class="card-middle" style="padding: 0">

                            <h4 class="text-center mt-1"> {{ $value->table->name }}</h4>
                            </h2>
                        </div>

                        <div class="card-footer" style="padding: 0;background: aliceblue;">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0 w-100"
                                            style="padding:0!important">
                                            <thead>

                                                <tr>
                                                    <th width=40%>Items</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($value->orderItems as $item)
                                                    <tr>
                                                        <td style="padding: 0">
                                                            {{ $item->menuItem->name }}</td>
                                                        <td style="padding: 0" class="text-center">
                                                            {{ $item->quantity }}</td>
                                                        <td style="padding: 0">
                                                            {{ config('app.price') }}
                                                            {{ $item->price }}</td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                        <hr style="margin:0">
                                        <p class="text-end pb-0" style="margin-bottom: 0">Order Total:
                                            {{ config('app.price') }} <b>{{ $value->total }}</b> </p>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="" class="btn btn-success btn-sm text-center mt-2"
                                data-bs-toggle="modal"
                                data-bs-target="#receiptModalCompleted-{{ $value->id }}">View
                                Receipt </a>



                            <!-- Receipt Modal completed orders-->
                            <div class="modal fade" id="receiptModalCompleted-{{ $value->id }}"
                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Payment
                                                Details</h5>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="receipttest-{{ $value->id }}" class="receipt">
                                                <div class="ticket centered">
                                                    {{-- <img src="./logo.png" alt="Logo"> --}}
                                                    <p class="centered" id="my-pad-bot">
                                                        <b>{{ config('app.name') }}</b>
                                                        <br>Satdobato,lalitpur
                                                    </p>

                                                    <table class="my-pad-30">
                                                        <thead>
                                                            <tr>

                                                                <th class="description left">Items</th>
                                                                <th class="quantity left">Quantity</th>
                                                                <th class="description left">Per unit
                                                                </th>
                                                                <th class="price left">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($value->orderItems as $item)
                                                                <tr>
                                                                    <td class="description">
                                                                        {{ $item->menuItem->name }}
                                                                    </td>
                                                                    <td class="quantity">
                                                                        {{ $item->quantity }}</td>
                                                                    <td class="description">
                                                                        {{ $item->menuItem->price }}
                                                                    </td>
                                                                    <td class="price">
                                                                        {{ $item->menuItem->price * $item->quantity }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                    <span class="float-end">Grand Total:
                                                        <b>{{ $value->total }}</b> </span>
                                                    <br>
                                                    <p class="centered">** Thanks for coming **
                                                        <br>** Please visit again **
                                                    </p>
                                                </div>
                                                <button id="btnPrint{{$value->id}}"
                                                    class="hidden-print btn btn-success btn-sm">Print
                                                    Receipt</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
