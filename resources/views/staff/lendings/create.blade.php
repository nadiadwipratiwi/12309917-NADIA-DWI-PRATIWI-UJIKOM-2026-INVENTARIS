@extends('dashboard')
@section('content')
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Add Lendings</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('lendings.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>

                        <div id="item-container">
                            <div class="item-group border p-3 mb-3 position-relative">
                                <div class="mb-3">
                                    <label class="form-label">Items</label>
                                    <select name="item_id[]" class="form-select" required>
                                        <option value="" selected disabled>Select Items</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Total</label>
                                    <input type="number" name="quantity[]" class="form-control" placeholder="total item"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="button" id="add-more" class="btn btn-link text-info text-decoration-none p-0">
                                <i class="fas fa-chevron-down"></i> More
                            </button>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ket.</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-more').addEventListener('click', function() {
            let container = document.getElementById('item-container');
            let originalGroup = document.querySelector('.item-group');
            let newGroup = originalGroup.cloneNode(true);

            // Kosongkan input di grup baru
            newGroup.querySelectorAll('input').forEach(i => i.value = '');
            newGroup.querySelectorAll('select').forEach(s => s.selectedIndex = 0);

            // Tambahkan tombol hapus (X) di grup baru
            let removeBtn = document.createElement('button');
            removeBtn.innerHTML = '&times;';
            removeBtn.type = 'button';
            removeBtn.style =
                "position:absolute; top:10px; right:10px; border:none; background:#e3342f; color:white; border-radius:3px; padding:0 8px;";

            removeBtn.onclick = function() {
                newGroup.remove();
            };

            newGroup.appendChild(removeBtn);
            container.appendChild(newGroup);
        });
    </script>
@endsection
