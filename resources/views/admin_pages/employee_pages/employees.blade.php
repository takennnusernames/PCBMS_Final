<x-admin_layout>

    <body>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Employees</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/add_employee">Add Employees</a></li>
                            <li class="breadcrumb-item active">List Employees</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">

                    @unless (count($employees) == 0)

                        <div class="row">
                            @foreach ($employees as $employee)
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                    <div class="card bg-light d-flex flex-fill">
                                        <div class="card-header text-muted border-bottom-0 text-uppercase">
                                            <div class="row">
                                                <div class="col-8">
                                                    {{ $employee->role }}
                                                </div>
                                                <div class="col-4 text-right">
                                                    <button type="button" class="btn btn-info btn-sm openModalButton"
                                                        data-id="{{ $employee['id'] }}" title="Edit Employee">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm deleteButton"
                                                        data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"
                                                        data-id="{{ $employee['id'] }}" title="Delete Employee">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead">
                                                        <b><strong>{{ ucwords(strtolower($employee->name)) }}</strong></b>
                                                    </h2>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small text-capitalize"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-building"></i></span>
                                                            {{ ucwords(strtolower($employee->address)) }}</li>
                                                        <li class="small"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-phone"></i></span>
                                                            {{ $employee->phone }}</li>
                                                        <li class="small"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-envelope"></i></span>
                                                            {{ $employee->email }}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="adminlte/img/user1-128x128.jpg" alt="user-avatar"
                                                        class="img-circle img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        No Employees Registered
                    @endunless
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <nav aria-label="Contacts Page Navigation">
                        <ul class="pagination justify-content-center m-0">
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->

        </section>
    </body>
</x-admin_layout>

<div class="modal fade" id="modal-edit-employee">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Employee Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/edit_employee" method="POST">
                    @csrf
                    <input type="text" name="id" hidden id="employeeId">
                    <div class="container-fluid w-70">
                        <div class="row mb-3">
                            <div class="col-md">
                                <div class="form-floating">
                                    <input name="FirstName" type="text" class="form-control text-capitalize"
                                        id="floatingInputFirst" placeholder="name">
                                    <label for="floatingInput" class="form-label">First Name</label>
                                    <span validation-for="FirstName" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <input name="MiddleName" type="text" class="form-control text-capitalize"
                                        id="floatingInputMiddle" placeholder="name">
                                    <label for="floatingInput" class="form-label">Middle Name</label>
                                    <span validation-for="MiddleName" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <input name="LastName" type="text" class="form-control text-capitalize"
                                        id="floatingInputLast" placeholder="name">
                                    <label for="floatingInput" class="form-label">Last Name</label>
                                    <span validation-for="LastName" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="address" type="text" class="form-control" id="floatingInputAddress"
                                placeholder="address">
                            <label for="address" for="floatingInput" class="form-label">Address</label>
                            <span validation-for="address" class="text-danger"></span>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="email" type="email" class="form-control" id="floatingInputEmail"
                                placeholder="name@example.com">
                            <label for="Email" for="floatingInput" class="form-label">Email Address</label>
                            <span validation-for="Email" class="text-danger"></span>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="phone" type="text" class="form-control" id="floatingInputPhone"
                                placeholder="address">
                            <label for="phone" for="floatingInput" class="form-label">Phone Number</label>
                            <span validation-for="phone" class="text-danger"></span>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="role" class="form-select" id="floatingSelect"
                                aria-label="Floating label select example">
                                <option selected>Select Employee Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Manager</option>
                                <option value="3">Cashier</option>
                            </select>
                            <label for="floatingSelect">Role</label>
                        </div>
                        <div class="bottom-btn">
                            <a class="btn btn-danger cancel" type="button" controller="Admin"
                                action="HrList">Cancel</a>
                            <button type="submit" value="Login" class="btn btn-success">Update Employee</button>
                        </div>
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
                    Are you sure you want to delete this employee?
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
        // Handle modal toggling
        $('.openModalButton').click(function() {

            // Get the id from the data-id attribute of the clicked button
            var id = $(this).data('id');

            // Show the modal
            $('#modal-edit-employee').modal('show');

            // Fetch data from the server using AJAX
            $.ajax({
                url: '/fetch-employee/' + id, // Your route URL
                method: 'GET',
                success: function(response) {
                    // Populate the modal with the fetched data
                    $('#floatingInputFirst').val(response.data["name"].split(' ')[0]);
                    var nameWords = response.data["name"].split(' ');
                    if (nameWords.length === 2) {
                        // Name has 2 words, set the second word in #floatingInputMiddle
                        $('#floatingInputMiddle').val(" ");
                        $('#floatingInputLast').val(nameWords[1]);
                    } else if (nameWords.length === 3) {
                        // Name has 3 words, set the second and third words in #floatingInputMiddle
                        $('#floatingInputMiddle').val(nameWords[1]);
                        $('#floatingInputLast').val(nameWords[2]);
                    } else {
                        // Handle other cases as needed
                        $('#floatingInputMiddle').val(''); // Clear the input if it doesn't match the expected format
                    }
                    $('#floatingInputAddress').val(response.data["address"]);
                    $('#floatingInputEmail').val(response.data["email"]);
                    $('#floatingInputPhone').val(response.data["phone"]);
                    $('#employeeId').val(response.data["id"]);
                    var roleSelect = $('#floatingSelect');

                    switch (response.data["role"]) {
                        case "admin":
                            roleSelect.val(1);
                            break;
                        case "manager":
                            roleSelect.val(2);
                            break;
                        case "cashier":
                            roleSelect.val(3);
                            break;
                            // Add similar cases for other roles
                    }
                    // Add similar lines for other fields
                },
            });
        });
        $('#modal-edit-employee').on('click', '.cancel', function() {
            // Use Bootstrap's modal 'hide' method to close the modal
            $('#modal-edit-employee').modal('hide');
        });
    });

    $(document).ready(function() {
        // Handle the click event for the Delete button
        $('.deleteButton').click(function() {
            var id = $(this).data('id'); // Assuming you have a data-id attribute on the button

            // Set the form's action attribute based on the data-id value
            $('#deleteForm').attr('action', 'delete_employee/' + id);

            // Show a confirmation dialog or perform other actions as needed

            // Submit the form (optional)
            // $('#deleteForm').submit();
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>