@extends('dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Add Category</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.update', $categories->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="division_pj" class="form-label">Division PJ</label>
                            <select class="form-select" name="division_pj" required>
                                <option value="Sarpras">Sarpras
                                </option>
                                <option value="Tata Usaha">
                                    Tata Usaha</option>
                                <option value="Tefa">Tefa
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn bg-green text-white">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
