@extends('dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Add Items</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('items.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" name="category_id" required>
                                <option value="" selected disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="total_stock" class="form-label">Total</label>
                            <input type="text" name="total_stock" id="total_stock" class="form-control" required>
                        </div>
                        <button type="submit" class="btn bg-green text-white">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
