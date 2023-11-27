<title>POS</title>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="../../adminlte/img/vsu.png" type="image/x-icon">

</head>
{{-- #region Links --}}
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="../../adminlte/plugins/fontawesome-free/css/all.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="../../adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../../adminlte/css/adminlte.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="../../adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../../adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">


{{-- #endregion --}}

{{-- <x-admin_layout></x-admin_layout> --}}

{{-- <x-nav_bar></x-nav_bar> --}}

<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="/pos-cashier" class="navbar-brand">
            <span class="brand-text font-weight-light">VSU Pasalubong Center</span>
        </a>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item">
              <form action="/logout" method="Post">
                @csrf
                <button class="btn btn-danger" type="submit">
                  <i class="fas fa-sign-out-alt"></i>LOGOUT
                </button>
              </form>
            </li>
          </ul>
    </div>
</nav>

<body>
    <div class="container">
        {{-- <div class="row">
            <div class="col-5">
                <table>
                    <tr>
                        <td>Cashier:</td>
                        <td colspan="3" class="text-center"><strong>John Doe</strong></td>
                        <td id="current-date" class="text-end"></td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                Grand Total:
            </div>
        </div> --}}
        <div class="row gx-3">
            <div class="col-4" style="height: 500px; display: flex; flex-direction: column;">
                <form action="">
                    <div class="card table-responsive" style="max-height: 300px;">
                        <table class="table table-bordered card-body" id="table">
                            <thead>
                                <tr>
                                    <td>Cashier:</td>
                                    <td colspan="3" class="text-center"><strong id="cashier">
                                        {{ auth()->check() ? auth()->user()->name : '' }} </strong></td>
                                    <td id="current-date" class="text-end"></td>
                                </tr>
                                <tr class="text-center">
                                    <th scope="col">Item</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                {{-- <input type="number" name="count" id="count" value="0" hidden> --}}
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer text-end">
                        <div>
                            Total items: <strong id="totalItems">0</strong>
                        </div>
                        <div>
                            Total Amount: <strong>₱<span id="totalAmount">0</span></strong>
                        </div>
                        <button type="button" class="btn btn-primary flex-fill mt-3" data-bs-toggle="modal"
                            data-bs-target="#modal-checkout" style="display: none" id="checkoutButton">
                            Checkout
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-8">
                <section class="container">
                    <div class="card card-solid">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-4">
                                    Products
                                </div>
                                <div class="col-6">
                                    <form class="form-inline ml-0 ml-md-3">
                                        <div class="input-group input-group-sm">
                                            <input class="form-control form-control-navbar" type="search"
                                                placeholder="Search" aria-label="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-navbar" type="submit">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($products as $product)
                                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                        <button type="button" class="btn productButton"
                                            data-id="{{ $product->id }}">
                                            <div class="card bg-light d-flex flex-fill">
                                                <div class="card-header text-muted border-bottom-0 text-uppercase">
                                                    <div class="row">
                                                        <div class="col text-left">
                                                            {{ $product->name }}
                                                        </div>
                                                        <div class="col text-right">
                                                            <strong>₱{{ $product->price }}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body pt-0 text-center">
                                                    <div class="row">
                                                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('../../adminlte/img/prod-1.jpg') }}"
                                                            class="img-circle img-fluid" alt="Product Image"
                                                            style="height: 200px;">
                                                        <div
                                                            class="card-footer text-muted border-bottom-0 text-uppercase">
                                                            {{ $product->code }}
                                                        </div>
                                                    </div>
                                                </div>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                </section>
            </div>
        </div>
    </div>
</body>


<!-- Modal -->
<div class="modal fade" id="modal-item-qty" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter Quantity</h5>
                <button type="button" class="close" id="cancel" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="qtyInput" type="number" class="form-control" required>
            </div>
            <div class="modal-footer" id="submitFooter" style="display: none;">
                <button type="submit" class="btn btn-primary" id="submitButton"
                    data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-checkout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Sales Checkout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating">
                    <input type="text" class="form-control" placeholder="Total" disabled>
                    <label for="total">Amount to Pay: ₱<span id="checkoutTotal"></span></label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" id="paymentInput" placeholder="Payment"
                        name="payment">
                    <label for="test">Enter Cash</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    id="cancelPayment">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="checkOut()" disabled
                    id="checkoutPayment">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-final-checkout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Sales Checkout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1 class="text-center">Change: ₱<span id="checkoutChange"></span></h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="store()">OK</button>
            </div>
        </div>
    </div>
</div>



<script src="../../adminlte/plugins/jquery/jquery.min.js"></script>
{{-- Modal Script --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle modal toggling
        $('.productButton').click(function() {

            // Get the id from the data-id attribute of the clicked button
            var id = $(this).data('id');
            console.log(id);
            // Show the modal
            $('#modal-item-qty').modal('show');
            $('#modal-item-qty').on('shown.bs.modal', function() {
                setTimeout(function() {
                    $("#qtyInput").focus();
                }, 100); // Adjust the timeout value as needed
            });
            wait()
                .then(function(qtyValue) {
                    $.ajax({
                        url: '/fetch-product/' + id, // Your route URL
                        method: 'GET',
                        success: createItem
                    });
                })
                .catch(function(error) {
                    console.error("Error waiting for input: " + error);
                });
        });
        $('#modal-item-qty').on('click', '.cancel', function() {
            // Use Bootstrap's modal 'hide' method to close the modal
            $('#qtyInput').val('');
            $('#modal-item-qty').modal('hide');
        });

    });

    $(document).ready(function() {
        $('#qtyInput').on('input', function() {
            if ($(this).val().trim() !== '') {
                setTimeout(function() {
                    $('#submitFooter').show();
                }, 100);
            } else {
                $('#submitFooter').hide();
            }
        });
        $('#modal-item-qty').on('hidden.bs.modal', function() {
            $('#submitFooter').hide();
        });

        $('#paymentInput').on('input', function() {
            var total = parseFloat($("#checkoutTotal").text());
            var button = document.getElementById("checkoutPayment")
            if ($(this).val() > total) {
                setTimeout(function() {
                    button.disabled = false;
                }, 100);
            } else {
                button.disabled = true;
            }
        });

        $('#tbody').on('DOMSubtreeModified', function() {
            if ($('#tbody tr').length > 0) {
                $('#checkoutButton').show();
            } else {
                $('#checkoutButton').hide();
            }
        });
    });

    function wait() {
        return new Promise(function(resolve, reject) {
            $('#submitButton').one('click', function() {
                var qtyInputValue = $('#qtyInput').val();
                if (qtyInputValue) {
                    resolve();
                } else {
                    $('#qtyInput').val('');
                    $('#modal-item-qty').modal('hide');
                    reject("Cancelled");
                }
            });

            $('#qtyInput').on('keydown', function(event) {
                if (event.key === 'Enter') {
                    var qtyInputValue = $(this).val();
                    if (qtyInputValue) {
                        $('#modal-item-qty').modal('hide');
                        resolve();
                    }
                }
            });

            $('#cancel').one('click', function() {
                // Cancel the Ajax request if it's active
                $('#qtyInput').val('');
                reject("Cancelled");
            });
        });
    }

    function createItem(response) {
        var item = document.createElement("tr");

        var code = document.createElement("td");
        var name = document.createElement("td");
        var qty = document.createElement("td");
        var price = document.createElement("td");
        var unit = document.createElement("td");
        var total = document.createElement("td");
        total.className = "text-end";

        var qtyInput = document.getElementById("qtyInput");
        var qtyValue = parseFloat(qtyInput.value);

        var itemTotal = parseFloat((response.data.price * qtyValue).toFixed(2));
        var formattedNumber = itemTotal.toFixed(2);

        code.textContent = response.data.code
        code.hidden = true;

        name.textContent = response.data.name;
        qty.textContent = qtyValue;
        price.textContent = response.data.price;
        unit.textContent = response.data.unit;
        total.textContent = "₱" + formattedNumber;

        item.appendChild(name);
        item.appendChild(qty);
        item.appendChild(price);
        item.appendChild(unit);
        item.appendChild(total);
        item.appendChild(code);

        var table = document.getElementById("tbody");

        // Find the last row in the table
        var lastRow = table.rows[table.rows.length];

        // Append the new cell to the last row
        table.appendChild(item);
        $('#qtyInput').val('');

        var currentTotal = parseFloat($("#totalAmount").text());
        var newTotal = currentTotal + itemTotal;
        formattedTotalNumber = newTotal.toFixed(2);
        $("#totalAmount").text(formattedTotalNumber);
        $("#checkoutTotal").text(formattedTotalNumber);

        var totalItems = parseFloat($("#totalItems").text());
        var newItemTotal = totalItems + qtyValue;
        $("#totalItems").text(newItemTotal);
    }

    function checkOut() {
        var amount = parseFloat($("#checkoutTotal").text());
        var payment = parseFloat($("#paymentInput").val());

        var change = (payment - amount).toFixed(2);
        
        $('#modal-checkout').modal('hide');
        
        $("#checkoutChange").text(change);
        $('#modal-checkout').on('hidden.bs.modal', function() {
                setTimeout(function() {
                    $('#modal-final-checkout').modal('show');
                }, 100); // Adjust the timeout value as needed
            });

    }

    $('#cancelPayment').one('click', function() {
        // Cancel the Ajax request if it's active
        $('#paymentInput').val('');
    });

    function store() {
        var table = document.getElementById('table');
        var total = parseFloat($("#totalAmount").text());
        var change = parseFloat($("#checkoutChange").text());
        var items = 0;
        var data = [];
        var item = [];

        for (var i = 2; i < table.rows.length; i++) {
            var row = table.rows[i];
            var rowData = {
                item_code: row.cells[5].textContent,
                quantity: row.cells[1].textContent,
                total: row.cells[4].textContent
            };
            items = items + parseFloat(row.cells[1].textContent);
            item.push(rowData);
        }
        var transaction = {
            cashier: $('#cashier').text(),
            date: $('#current-date').text(),
            time: currentDate.toLocaleTimeString(),
            grandTotal: total,
            cash: total + change,
            change: change,
            items: items
        }
        data.push(item);
        data.push(transaction);
        console.log(data);
        console.log(data[0]);

        $.ajax({
                url: '/save_reciept',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify(data),
                contentType: 'application/json',
            })
            .then(response => {
                if (response.ok) {
                    console.log('Data saved successfully.');
                    // Refresh the page when the response is okay
                    $('#modal-final-checkout').modal('hide');

                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    Toast.fire({
                        icon: 'success',
                        title: response.message // Use the message from the response
                    });

                    setTimeout(function() {
                        window.onbeforeunload = null;
                        location.reload();
                    }, 30);

                } else {
                    console.error('Error saving data');
                }
            })
            .catch(error => {
                console.error('Network error:', error);
            });
    }
</script>
<script>
    var currentDate = new Date();
    // var currentTime = new Date();

    // Format the date as a string (e.g., "October 17, 2023")
    var formattedDate = currentDate.toLocaleDateString();
    // var formattedTime = currentDate.toLocaleTimeString();

    // Display the formatted date in an HTML element with the id "date-display"
    document.getElementById("current-date").textContent = formattedDate;
    // document.getElementById("current-time").textContent = formattedTime;
</script>

<script src="../../adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
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
        subtitle: 'Failed to add data',
        body: '{!! session('error') !!}'
      })
    });
</script>
@endif

<script>
    window.onbeforeunload = function() {
        return "Are you sure you want to leave?";
    };
</script>

