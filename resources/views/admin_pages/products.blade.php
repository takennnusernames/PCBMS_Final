<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../../adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../../adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<x-admin_layout>

    <body>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Layout</a></li>
                            <li class="breadcrumb-item active">Fixed Layout</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary openModalButton" data-toggle="modal"
                                    data-target="#modal-add-product">Add
                                    Products</button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Supplier</th>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Stock Quantity</th>
                                            <th>SRP</th>
                                            <th>Date of latest restock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @unless (count($products) == 0)
                                            @foreach ($products as $product)
                                                <tr onclick="window.location.href='/product/{{$product['id']}}'" style="cursor:pointer;">
                                                    <td> {{ $product->supplier['Company Name'] }} </td>
                                                    <td> {{ $product['code'] }} </td>
                                                    <td> {{ $product['name'] }} </td>
                                                    <td> {{ $product['qty'] }} </td>
                                                    <td> {{ $product['srp'] }} </td>
                                                    <td>
                                                        @if ($product['restock'] !== null)
                                                            {{ $product['restock'] }}
                                                        @else
                                                            Not yet stocked
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <th colspan="6" class="text-center">No Products found</th>
                                            </tr>
                                        @endunless
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </body>
    <!-- jQuery -->

</x-admin_layout>

<!-- Modal -->
<div class="modal fade" id="modal-add-product">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Product details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm" method="post" action="/add_product" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="companyName">Supplier</label>
                            <select name="supplier" class="form-control" id="companyName" placeholder="Supplier">
                                <option value="">Select Supplier</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Product Sample Image</label>
                            <input name="image" class="form-control" type="file" id="formFile">
                        </div>
                        <div class="form-group">
                            <label for="acronym">Product Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Product Name">
                        </div>
                        <div class="form-group">
                            <label for="acronym">Product Description</label>
                            <textarea type="text" name="description" class="form-control" placeholder="Product Description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="unit">Product Unit</label>
                            <select name="unit" class="form-control" placeholder="Unit">
                                <option value="">Select Unit</option>
                                <option value="1">pack</option>
                                <option value="2">piece</option>
                                <option value="3">bottle</option>
                                <option value="4">box</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Suggested Retail Price</label>
                            <input type="text" name="srp" class="form-control" id="address"
                                placeholder="Suggested Retail Price">
                        </div>
                        <div class="form-group">
                            <label for="address">Selling Price</label>
                            <input type="text" name="price" class="form-control" id="address"
                                placeholder="Selling Price">
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add product</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

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


            },
        });
        $('#modal-edit-supplier').on('click', '.close, .btn-close', function() {
            // Use Bootstrap's modal 'hide' method to close the modal
            $('#modal-edit-supplier').modal('hide');
        });
    });
</script>

<script src="../../adminlte/plugins/jquery/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & adminlte/Plugins -->
<script src="../../adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../adminlte/plugins/jszip/jszip.min.js"></script>
<script src="../../adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
