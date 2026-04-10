@extends('dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-table me-2 text-green"></i> Tabel Lendings</h5>
                    <div class="d-flex justify-content-end gap-2 mb-3">
                        <a href="" class="btn bg-green btn-sm px-3 shadow-sm text-white">
                            Export
                        </a>
                        <a href="{{ route('lendings.create') }}" class="btn bg-green btn-sm px-3 shadow-sm text-white">
                            <i class="fas fa-plus me-1"></i> Add
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lendings as $index => $lending)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @foreach ($lending->lendingDetails as $detail)
                                                {{ $detail->item->name }} ({{ $detail->quantity }}) <br>
                                            @endforeach
                                        </td>
                                        <td>{{ $lending->lendingDetails->sum('quantity') }}</td>
                                        <td>{{ $lending->name }}</td>
                                        <td>{{ $lending->description }}</td>
                                        <td>{{ $lending->lend_date }}</td>
                                        <td>
                                            @if ($lending->status == 'borrowed')
                                                <span class="badge bg-warning text-dark">not returned</span>
                                            @else
                                                <span class="badge bg-success">{{ $lending->return_date }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $lending->user->role }}</td>
                                        <td>
                                            @if ($lending->status == 'borrowed')
                                                <a href="{{ route('lendings.edit', $lending->id) }}"
                                                    class="btn btn-sm btn-info text-white">
                                                    Returned
                                                </a>
                                            @endif
                                            <form action="{{ route('lendings.destroy', $lending->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this lending?')">Delete</button>
                                            </form>
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
