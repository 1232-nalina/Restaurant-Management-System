<div class="tab-pane show active" id="solid-justified-tab1">
    <div class="row">

        @if ($pendingorders)
            @foreach ($pendingorders as $key => $value)
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
                                                    <th>Items</th>
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
                            @if ($whouser->can('payment.make'))
                                <a type="button" class="btn btn-primary btn-sm text-center mt-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#paymentModal-{{ $value->id }}">
                                    Make Payment
                                </a>
                            @endif

                            <a href="{{route('order.edit',$value->id)}}" class="btn btn-primary btn-sm text-center mt-2">Update
                                Order </a>



                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
