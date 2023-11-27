<x-admin_layout>

    <body>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Employees</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/employees">List Employees</a></li>
                            <li class="breadcrumb-item active">Add Employees</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0 mb-3">
                    <form action="/addEmployee" method="POST">
                        @csrf
                        <div class="container-fluid w-50">
                            <div class="row mb-3">
                                <div class="col-md">
                                    <div class="form-floating">
                                        <input name="FirstName" type="text" class="form-control text-capitalize"
                                            id="floatingInput" placeholder="name" autofocus>
                                        <label for="floatingInput" class="form-label">First Name</label>
                                        <span validation-for="FirstName" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating">
                                        <input name="MiddleName" type="text" class="form-control text-capitalize"
                                            id="floatingInput" placeholder="name">
                                        <label for="floatingInput" class="form-label">Middle Name</label>
                                        <span validation-for="MiddleName" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating">
                                        <input name="LastName" type="text" class="form-control text-capitalize"
                                            id="floatingInput" placeholder="name">
                                        <label for="floatingInput" class="form-label">Last Name</label>
                                        <span validation-for="LastName" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="address" type="text" class="form-control" id="floatingInput"
                                    placeholder="address">
                                <label for="address" for="floatingInput" class="form-label">Address</label>
                                <span validation-for="address" class="text-danger"></span>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="email" type="email" class="form-control" id="floatingInput"
                                    placeholder="name@example.com">
                                <label for="Email" for="floatingInput" class="form-label">Email Address</label>
                                <span validation-for="Email" class="text-danger"></span>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="phone" type="text" class="form-control" id="floatingInput"
                                    placeholder="address">
                                <label for="phone" for="floatingInput" class="form-label">Phone Number</label>
                                <span validation-for="phone" class="text-danger"></span>
                            </div>
                            <div class="form-floating mb-3">
                                <select name="role" class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example">
                                    <option selected>Select Employee Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Cashier</option>
                                </select>
                                <label for="floatingSelect">Role</label>
                            </div>
                            <div class="bottom-btn">
                                <a class="btn btn-danger" type="button" controller="Admin" action="HrList">Cancel</a>
                                <button type="submit" value="Login" class="btn btn-success">Create Account</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->

        </section>
    </body>
</x-admin_layout>
