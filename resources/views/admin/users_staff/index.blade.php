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
                    <h5 class="mb-0 fw-bold"><i class="fas fa-table me-2 text-green"></i> Tabel Users Staff</h5>
                    <div class="d-flex justify-content-end gap-2 mb-3">
                        <a href="" class="btn bg-green btn-sm px-3 shadow-sm text-white">
                            Export
                        </a>
                        <a href="{{ route('users.create') }}" class="btn bg-green btn-sm px-3 shadow-sm text-white">
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <form action="{{ route('users.reset', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin reset password user ini?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-sync"></i> Reset Password
                                                    </button>
                                                </form>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                                </form>
                                            </div>
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
