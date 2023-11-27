<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/adminlte/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../../adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../../adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

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
                            <h3 class="my-3 text-uppercase">{{ $product->name }}</h3>
                            <p class="text-capitalize">{{ $product->description }} </p>

                            <hr>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <strong>Product Code:</strong>
                                        <br>
                                        {{ $product->code }}
                                    </div>
                                    <div class="col">
                                        <strong>Supplier:</strong>
                                        <br>
                                        {{$product->Supplier['Company Name']}}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <strong>Current Stock:</strong> 
                                        <br>
                                        {{ $product->qty }} {{ $product->unit }}/s
                                    </div>
                                    <div class="col">
                                        @if ($product->restock)
                                        <strong>Latest Restock:</strong> 
                                        <br>
                                        {{ $product->restock }}
                                    @else
                                        <strong>Latest Restock:</strong> 
                                        <br>
                                        Product is still new
                                    @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <strong>SRP:</strong>
                                        <br>
                                        {{$product->srp}}
                                    </div>
                                    <div class="col">
                                        <strong>Appreciation:</strong>
                                        <br>
                                        {{$product->appreciation}}%
                                    </div>
                                    <div class="col">
                                        <strong>Selling Price:</strong>
                                        <br>
                                        ₱{{$product->price}} per {{ $product->unit }}
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex">
                                
                                <a href="/edit_product_view/{{ $product['id'] }}">
                                <button type="button"
                                    class="btn btn-info btn-sm mx-1"
                                    >
                                    <i class="fas fa-pencil-alt"></i>
                                        Edit
                                </button></a>
                                <button type="button"
                                    class="btn btn-primary btn-sm mx-1 restockModalButton"
                                    data-bs-toggle="modal" data-bs-target="#restockModal"
                                    data-id="{{ $product['id'] }}">
                                    <i class="fas fa-cart-plus"></i>
                                    Restock
                                </button>
                                <button type="button" class="btn btn-danger btn-sm openModalButton"
                                    data-id="{{ $product['id'] }}">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </button>
                            </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<div class="modal fade" id="restockModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Stock</h5>
                <button type="button" class="close" id="cancel" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/order" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="companyName">Supplier</label>
                        <input class="form-control text-center" type="text" id="supplierName" disabled value="{{$product->supplier["Company Name"]}}">
                        <input type="hidden" name="supplier" value="{{$product->supplier["Email Address"]}}">
                    </div>
                    <div class="form-group">
                        <label for="productName">Product</label>
                        <input class="form-control text-center" type="text" id="productName" value="{{$product["name"]}}" disabled>
                        <input type="hidden" name="product" value="{{$product["name"]}}">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Number of {{$product["unit"]}}/s</label>
                        <input type="hidden" name="unit" value="{{$product["unit"]}}">
                        <input id="qtyInput" type="number" class="form-control" required name="qty">
                    </div>
                </div>
                <div class="modal-footer" id="submitFooter">
                    <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- 
<script>
$(document).ready(function() {
        // Handle modal toggling
        $('.restockModalButton').click(function() {

            // Get the id from the data-id attribute of the clicked button
            var id = $(this).data('id');

            // Fetch data from the server using AJAX
            $.ajax({
                url: '/fetch-product/' + id, // Your route URL
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    // Populate the modal with the fetched data
                    $('#qty').text(response.data["unit"]);
                    $('#supplierName').val(response.data.supplier["Company Name"]);
                    $('#productName').val(response.data["name"]);
                    // Add similar lines for other fields
                },
            });
        });
    });
    
</script> --}}