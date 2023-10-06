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
                            {{-- <div class="col-12 product-image-thumbs">
                      <div class="product-image-thumb active"><img src="../../adminlte/img/prod-1.jpg" alt="Product Image"></div>
                      <div class="product-image-thumb" ><img src="../../adminlte/img/prod-2.jpg" alt="Product Image"></div>
                      <div class="product-image-thumb" ><img src="../../adminlte/img/prod-3.jpg" alt="Product Image"></div>
                      <div class="product-image-thumb" ><img src="../../adminlte/img/prod-4.jpg" alt="Product Image"></div>
                      <div class="product-image-thumb" ><img src="../../adminlte/img/prod-5.jpg" alt="Product Image"></div>
                    </div> --}}
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3 class="my-3 text-uppercase">{{ $product->name }}</h3>
                            <p class="text-capitalize">{{ $product->supplier['Company Name'] }} </p>

                            <hr>
                            <div class="bg-green py-2 px-3 mt-4">
                                <h2 class="mb-0">
                                    <strong>Description:</strong> {{ $product->description }}
                                </h2>
                            </div>

                            <div class="bg-gray py-2 px-3 mt-4">
                                <h2 class="mb-0">
                                    <strong>Current Stock:</strong> {{ $product->qty }} {{ $product->unit }}/s
                                </h2>
                            </div>
                            <div class="bg-gray py-2 px-3 mt-4">
                                <h2 class="mb-0">
                                    @if ($product->restock)
                                        <strong>Latest Restock:</strong> {{ $product->restock }}
                                    @else
                                        <strong>Latest Restock:</strong> Product is still new
                                    @endif
                                </h2>
                            </div>


                            <div class="bg-gray py-2 px-3 mt-4">
                                <h2 class="mb-0">
                                    <strong>Price:</strong> ₱{{ $product->price }}
                                </h2>
                            </div>

                            <button>Restock</button>
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
