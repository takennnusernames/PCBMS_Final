<x-admin_layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex">

                    <h1>
                        <a href="/sales" style="text-decoration: none; color:black">
                            <i class="fa fa-caret-left"></i>
                            Sales
                        </a>
                    </h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> VSU Pasalubong Center
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <b>Invoice #{{ $transaction['id'] }} </b><br>
                                <br>
                                <b>Cashier:</b> {{ $transaction['cashier'] }}<br>
                                <b>Date:</b> {{ $transaction['transaction_date'] }}<br>
                                <b>Time:</b> {{ $transaction['transaction_time'] }}
                            </div>
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Product Code</th>
                                            <th>Unit</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaction->transaction_items as $product)
                                            <tr>
                                                <td id="product{{ $product->product_code }}"></td>
                                                <td>{{ $product['product_code'] }}</td>
                                                <td id="unit{{ $product->product_code }}"></td>
                                                <td>{{ $product['quantity'] }}</td>
                                                <td id="subtotal{{ $product->product_code }}"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-6">
                                <p class="lead">Amount Due 2/22/2014</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Total:</th>
                                            <td>₱{{ $transaction->grand_total }}</td>
                                        </tr>
                                        <tr>
                                            <th>Cash:</th>
                                            <td>₱{{ $transaction->payment }}</td>
                                        </tr>
                                        <tr>
                                            <th>Change:</th>
                                            <td>₱{{ $transaction->change }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    {{-- <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                </div>
              </div> --}}
            </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</x-admin_layout>


@foreach ($transaction->transaction_items as $product)
    <script>
        $(document).ready(function() {
            var productCode = {{ $product->product_code }};
            var quantity = {{ $product->quantity }};
            $.ajax({
                type: 'GET',
                url: '/fetch-productCode/' + productCode,
                success: function(response) {
                    // Update the table cells with the fetched data
                    $('#product' + productCode).text(response.data.name);
                    $('#unit' + productCode).text(response.data.unit);
                    var subtotal = (quantity * response.data.price).toFixed(2);
                    $('#subtotal' + productCode).text("₱" + subtotal);
                    console.log(response)
                    // Add other fields as needed
                },
                error: function() {
                    console.log('Error fetching item details');
                }
            });
        });
    </script>
@endforeach
