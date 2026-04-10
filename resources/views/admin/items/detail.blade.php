@extends('dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-table me-2 text-green"></i> Tabel Lendings</h5>
                    <div class="d-flex justify-content-end gap-2 mb-3">
                        <a href="{{ route('items.index') }}" class="btn bg-green btn-sm px-3 shadow-sm text-white">
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Item</th>
                                    <th>Total</th>
                                    <th>Name</th>
                                    <th>Ket.</th>
                                    <th>Date</th>
                                    <th>Returned</th>
                                    <th>Edited By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $index => $detail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $detail->item->name }} ({{ $detail->quantity }})
                                        </td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>{{ $detail->lending->name }}</td>
                                        <td>{{ $detail->lending->description }}</td>
                                        <td>{{ $detail->lending->lend_date }}</td>
                                        <td>
                                            @if ($detail->lending->status == 'borrowed')
                                                <span class="badge bg-warning text-dark">not returned</span>
                                            @else
                                                <span class="badge bg-success">{{ $detail->lending->return_date }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $detail->lending->user->role }}</td>
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
