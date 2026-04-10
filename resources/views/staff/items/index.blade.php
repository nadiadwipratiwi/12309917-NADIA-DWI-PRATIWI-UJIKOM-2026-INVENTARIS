@extends('dashboard')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-table me-2 text-green"></i> Tabel Items</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Total</th>
                                    <th>Available</th>
                                    <th>Lending</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $index => $item)
                                    <tr>
                                        <td>{{ $index . 1 }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->total_stock }}</td>
                                        <td>
                                            @php
                                                $available = $item->total_stock - $item->repair;
                                            @endphp

                                            {{ $available }}
                                        </td>
                                        <td>
                                            @php
                                                // Ambil jumlah quantity yang lending-nya berstatus 'borrowed'
                                                $totalDipinjam = $item->lendingDetails
                                                    ->where('lending.status', 'borrowed')
                                                    ->sum('quantity');
                                            @endphp

                                            {{ $totalDipinjam }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
