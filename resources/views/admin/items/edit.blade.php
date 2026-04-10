@extends('dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Edit Items</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('items.update', $items->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $items->name) }}"
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" name="category_id" required>
                                <option value="" selected disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $items->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="total_stock" class="form-label">Total</label>
                            <input type="text" name="total_stock" id="total_stock"
                                value="{{ old('total_stock', $items->total_stock) }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-start gap-2 mb-3 ">
                                <label class="form-label">
                                    New Broke Item
                                    <small class="text-muted">
                                        Currently: {{ $items->repair }}
                                    </small>
                                </label>
                            </div>
                            <input type="number" name="new_broke_item" class="form-control mt-1" min="0"
                                value="0">
                        </div>
                        <button type="submit" class="btn bg-green text-white">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
