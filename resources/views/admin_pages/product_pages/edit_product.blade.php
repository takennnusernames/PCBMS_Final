<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/adminlte/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../../adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../../adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="../../adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<x-admin_layout>

    <body>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 d-flex">

                        <h1>
                            <a href="/products" style="text-decoration: none; color:black">
                                <i class="fa fa-caret-left"></i>
                                Products
                            </a>
                        </h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h3 class="d-inline-block d-sm-none">{{ $product->name }}</h3>
                            <div class="col-12">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('../../adminlte/img/prod-1.jpg') }}"
                                    class="product-image" alt="Product Image">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <form action="/edit_product" method="POST">
                                @csrf
                                <input name="id" hidden value="{{$product->id}}">
                                    <h3 class="my-3 text-uppercase">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Product Name" required value="{{ $product->name }}">
                                    </h3>
                                    <textarea type="text" name="description" class="form-control" placeholder="Product Description" required rows="9">{{ $product->description }}
                                    </textarea>
        
                                    <hr>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                <strong>Product Code:</strong>
                                                <br>
                                                <input type="text" disabled class="form-control" value="{{ $product->code }}">
                                            </div>
                                            <div class="col">
                                                <strong>Current Stock:</strong>
                                                <br>
                                                <input type="number" class="form-control" value="{{ $product->qty }}" name="qty">
                                            </div>
                                            <div class="col">
                                                <strong>Unit:</strong>
                                                <br>
                                                <select name="unit" class="form-control" placeholder="Unit" required>
                                                    <option value="1" {{ $product->unit == 'pack' ? 'selected' : '' }}>pack
                                                    </option>
                                                    <option value="2" {{ $product->unit == 'piece' ? 'selected' : '' }}>
                                                        piece</option>
                                                    <option value="3" {{ $product->unit == 'bottle' ? 'selected' : '' }}>
                                                        bottle</option>
                                                    <option value="4" {{ $product->unit == 'box' ? 'selected' : '' }}>box
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <strong>Latest Restock:</strong>
                                                <br>
                                                <input type="date" name="restock" class="form-control"
                                                    value="{{ $product->restock }}">
                                            </div>
                                            <div class="col">
                                                <strong>Supplier:</strong>
                                                <br>
                                                <select name="supplier_id" class="form-control" id="companyName"
                                                    placeholder="Supplier" required>
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <strong>SRP:</strong>
                                                <br>
                                                <input type="text" class="form-control" value="{{ $product->srp }}" name="srp">
                                            </div>
                                            <div class="col">
                                                <strong>Appreciation:</strong>
                                                <br>
                                                <input type="text" class="form-control" value="{{$product->appreciation }}" name="appreciation">
                                            </div>
                                            <div class="col">
                                                <strong>Selling Price:</strong>
                                                <br>
                                                <input type="text" class="form-control" disabled value="₱{{ $product->price }} per {{ $product->unit }}">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-sm mx-1">
                                        <i class="fas fa-cart-plus"></i>
                                        Save
                                    </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
    </body>
    <!-- jQuery -->

</x-admin_layout>

<script>
    $(document).ready(function() {

        // Fetch data from the server using AJAX
        $.ajax({
            url: '/fetch-suppliers', // Your route URL
            method: 'GET',
            success: function(response) {
                // Get the select element
                var select = $('#companyName');

                // Loop through the response data and create options
                $.each(response.data, function(index, supplier) {
                    console.log(typeof supplier)
                    select.append($('<option>', {
                        value: supplier["id"],
                        text: supplier["Company Name"]
                    }));
                });

                var productSupplier =
                "{{ $product->supplier['id'] }}"; // Assuming $product->unit contains the unit value
                select.val(productSupplier); // Set the value of the select element
            },
        });
    });
</script>
<script src="../../adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@if (session('message'))
    <script>
        $(document).ready(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            Toast.fire({
                icon: 'success',
                title: '{{ session('message') }}'
            });
        });
    </script>
@elseif (session('error'))
<script>
    $(document).ready(function() {
      $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'ERROR',
        subtitle: 'Failed to update data',
        body: '{!! session('error') !!}'
      })
    });
</script>
@endif
