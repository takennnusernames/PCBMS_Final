<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                    <div class="col-sm-6">
                        <h1>Products</h1>
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
                                    Product</button>
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @unless (count($products) == 0)
                                            @foreach ($products as $product)
                                                <tr>
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
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="/product/{{ $product['id'] }}">
                                                                <button type="button" class="btn btn-info btn-sm mx-1">
                                                                    <i class="fas fa-eye"></i>
                                                                    Open
                                                                </button>
                                                            </a>
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm mx-1 deleteButton"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#deleteConfirmationModal"
                                                                data-id="{{ $product['id'] }}">
                                                                <i class="fas fa-trash"></i>
                                                                Delete
                                                            </button>
                                                        </div>
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
                            <select name="supplier" class="form-control" id="companyName" placeholder="Supplier"
                                required>
                                <option value="">Select Supplier</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Product Sample Image (Optional)</label>
                            <input name="image" class="form-control" type="file" id="formFile">
                        </div>
                        <div class="form-group">
                            <label for="acronym">Product Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Product Name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="acronym">Product Description</label>
                            <textarea type="text" name="description" class="form-control" placeholder="Product Description" rows="3"
                                required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="unit">Product Unit</label>
                            <select name="unit" class="form-control" placeholder="Unit" required>
                                <option value="">Select Unit</option>
                                <option value="1">pack</option>
                                <option value="2">piece</option>
                                <option value="3">bottle</option>
                                <option value="4">box</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Suggested Retail Price</label>
                            <input type="text" name="srp" class="form-control"
                                placeholder="Suggested Retail Price" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Product Appreciation (0-100)</label>
                            <input type="number" name="appreciation" class="form-control"
                                placeholder="Product Appreciation" min="0" max="100" required>
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

<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this supplier?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" id="deleteForm" action="">
                    @csrf
                    @method('DELETE') <!-- This is needed to indicate a DELETE request -->
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
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

    $(document).ready(function() {
        // Handle the click event for the Delete button
        $('.deleteButton').click(function() {
            var id = $(this).data('id'); // Assuming you have a data-id attribute on the button

            // Set the form's action attribute based on the data-id value
            $('#deleteForm').attr('action', 'delete_product/' + id);

            // Show a confirmation dialog or perform other actions as needed

            // Submit the form (optional)
            // $('#deleteForm').submit();
        });
    });
</script>

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
<!-- SweetAlert2 -->
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
@elseif (session('email'))
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
                title: '{{ session('email') }}'
            });
        });
    </script>
@elseif (session('error'))
    <script>
        $(document).ready(function() {
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'ERROR',
                subtitle: 'Failed to add data',
                body: '{!! session('error') !!}'
            })
        });
    </script>
@endif
