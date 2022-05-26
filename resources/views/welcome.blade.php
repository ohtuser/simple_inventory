@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header text-white bg-primay-blue justify-content-between d-flex">
            <h5>Dashboard</h5>
        </div>
        <div class="card-body">
            @if (user()->user_type == 1 || user()->user_type == 2)
                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h6 class="text-center">Admins</h6>
                            </div>
                            <div class="card-body p-1">
                                <h3 class="text-center"><b>{{ $users->where('user_type', 1)->count() }}</b></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h6 class="text-center">Stuffs</h6>
                            </div>
                            <div class="card-body p-1">
                                <h3 class="text-center"><b>{{ $users->where('user_type', 2)->count() }}</b></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h6 class="text-center">Clients</h6>
                            </div>
                            <div class="card-body p-1">
                                <h3 class="text-center"><b>{{ $users->whereIn('user_type', [3, 5])->count() }}</b></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h6 class="text-center">Vendors</h6>
                            </div>
                            <div class="card-body p-1">
                                <h3 class="text-center"><b>{{ $users->whereIn('user_type', [4, 5])->count() }}</b></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h6 class="text-center">Brands</h6>
                            </div>
                            <div class="card-body p-1">
                                <h3 class="text-center"><b>{{ $brands->count() }}</b></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h6 class="text-center">Category</h6>
                            </div>
                            <div class="card-body p-1">
                                <h3 class="text-center"><b>{{ $categories->count() }}</b></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h6 class="text-center">Unit</h6>
                            </div>
                            <div class="card-body p-1">
                                <h3 class="text-center"><b>{{ $units->count() }}</b></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h6 class="text-center">Products</h6>
                            </div>
                            <div class="card-body p-1">
                                <h3 class="text-center"><b>{{ $products->count() }}</b></h3>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h2>Welcome</h2>
            @endif

            @if (user()->user_type == 1)
                <h5 class="mt-5">Product Sold Ranking</h5>
                <canvas id="myChart" width="100" height="25"></canvas>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($product_names),
                datasets: [{
                    label: 'Product Sold Ranking',
                    data: @json($sold_qty),
                    backgroundColor: [
                        'rgba(255, 99, 132)',
                        'rgba(54, 162, 235)',
                        'rgba(255, 206, 86)',
                        'rgba(75, 192, 192)',
                        'rgba(153, 102, 255)',
                        'rgba(255, 159, 64)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
