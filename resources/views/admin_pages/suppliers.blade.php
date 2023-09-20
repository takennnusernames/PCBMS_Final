<x-admin_layout>
    <link rel="stylesheet" href="../../adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <body>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Suppliers</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Suppliers</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modal-add-supplier">Add
                        Supplier</button>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th>
                                    Company Name
                                </th>
                                <th style="width: 20%">
                                    Address
                                </th>
                                <th>
                                    Contact Person
                                </th>
                                <th>
                                    Contact Number
                                </th>
                                <th>
                                    Email Address
                                </th>
                                <th class="text-center">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @unless (count($suppliers) == 0)
                                    @foreach ($suppliers as $supplier)
                                        <tr>
                                            <td>
                                                @unless ($supplier['Company Acronym'] == ' ')
                                                    <a>
                                                        {{ $supplier['Company Acronym'] }}
                                                    </a>
                                                    <br />
                                                    <small>
                                                        {{ $supplier['Company Name'] }}
                                                    </small>
                                                @else
                                                    <a>
                                                        {{ $supplier['Company Name'] }}
                                                    </a>
                                                @endunless
                                            </td>
                                            <td>
                                                {{ $supplier['Address'] }}
                                            </td>
                                            <td>
                                                {{ $supplier['Contact Person'] }}
                                            </td>
                                            <td>
                                                {{ $supplier['Contact Number'] }}
                                            </td>
                                            <td>
                                                {{ $supplier['Email Address'] }}
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <button type="button" class="btn btn-info btn-sm openModalButton"
                                                        data-id="{{ $supplier['id'] }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                        Edit
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm flex-fill mx-1 deleteButton"
                                                        data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"
                                                        data-id="{{ $supplier['id'] }}">
                                                        <i class="fas fa-trash"></i>
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                            @else
                                <tr>
                                    <th colspan="6" class="text-center">No Suppliers found</th>
                                </tr>
                            @endunless
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
    </body>

    <!-- Modal -->
    <div class="modal fade" id="modal-add-supplier">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Large Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addForm" method="post" action="/add_supplier">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="companyName">Company Name</label>
                                <input type="text" name="companyName" class="form-control" id="companyName"
                                    placeholder="Company Name">
                            </div>
                            <div class="form-group">
                                <label for="acronym">Company Acronym (Leave blank if not applicable)</label>
                                <input type="text" name="acronym" class="form-control" id="companyName"
                                    placeholder="Company Acronym">
                            </div>
                            <div class="form-group">
                                <label for="address">Company Address</label>
                                <input type="text" name="address" class="form-control" id="address"
                                    placeholder="Company Address">
                            </div>
                            <div class="form-group">
                                <label for="contactPerson">Contact Person</label>
                                <input type="text" name="contactPerson" class="form-control" id="contactPerson"
                                    placeholder="Contact Person">
                            </div>
                            <div class="form-group">
                                <label for="contactNumber">Contact Number</label>
                                <input type="text" name="contactNumber" class="form-control" id="contactNumber"
                                    placeholder="Contact Number">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Email Address">
                            </div>
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-edit-supplier">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Large Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="post" action="/edit_supplier">
                        @csrf
                        <input type="text" name="id" hidden id="supplierId">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="companyName">Company Name</label>
                                <input type="text" name="companyName" class="form-control" id="editCompanyName"
                                    placeholder="Company Name">
                            </div>
                            <div class="form-group">
                                <label for="acronym">Company Acronym (Leave blank if not applicable)</label>
                                <input type="text" name="acronym" class="form-control" id="editCompanyAcronym"
                                    placeholder="Company Acronym">
                            </div>
                            <div class="form-group">
                                <label for="address">Company Address</label>
                                <input type="text" name="address" class="form-control" id="editAddress"
                                    placeholder="Company Address">
                            </div>
                            <div class="form-group">
                                <label for="contactPerson">Contact Person</label>
                                <input type="text" name="contactPerson" class="form-control"
                                    id="editContactPerson" placeholder="Contact Person">
                            </div>
                            <div class="form-group">
                                <label for="contactNumber">Contact Number</label>
                                <input type="text" name="contactNumber" class="form-control"
                                    id="editContactNumber" placeholder="Contact Number">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" class="form-control" id="editEmail"
                                    placeholder="Email Address">
                            </div>
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-close">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
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


</x-admin_layout>

<script>
    $(document).ready(function() {
        // Handle modal toggling
        $('.openModalButton').click(function() {

            // Get the id from the data-id attribute of the clicked button
            var id = $(this).data('id');

            // Show the modal
            $('#modal-edit-supplier').modal('show');

            // Fetch data from the server using AJAX
            $.ajax({
                url: '/fetch-data/' + id, // Your route URL
                method: 'GET',
                success: function(response) {
                    // Populate the modal with the fetched data
                    $('#supplierId').val(response.data["id"]);
                    $('#editCompanyName').val(response.data["Company Name"]);
                    $('#editCompanyAcronym').val(response.data["Company Acronym"]);
                    $('#editAddress').val(response.data["Address"]);
                    $('#editContactPerson').val(response.data["Contact Person"]);
                    $('#editContactNumber').val(response.data["Contact Number"]);
                    $('#editEmail').val(response.data["Email Address"]);
                    // Add similar lines for other fields
                },
            });
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
            $('#deleteForm').attr('action', '/delete_supplier/' + id);

            // Show a confirmation dialog or perform other actions as needed

            // Submit the form (optional)
            // $('#deleteForm').submit();
        });
    });
</script>
<!-- SweetAlert2 -->
<script src="../../adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
{{-- Modal Script --}}
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
@endif
