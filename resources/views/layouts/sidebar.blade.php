<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        INVENTARIS
    </div>
    <div class="mt-4">
        {{-- <div class="px-3 mb-2 small text-muted text-uppercase">Main Menu</div>
        <a href="" class="nav-link">Dashboard</a>
        <hr class="sidebar-divider"> --}}

        <a href="{{ route('categories.index') }}" class="nav-link">Categories</a>
        <a href="{{ route('items.index') }}" class="nav-link">Items</a>
        <a href="" class="nav-link">User Admin</a>
        <a href="" class="nav-link">User Staff</a>

        <a href="" class="nav-link">
            <i class="fas fa-hand-holding me-2"></i> Lending
        </a>
        <a href="" class="nav-link">
            <i class="fas fa-list me-2"></i> Item
        </a>
        <a href="" class="nav-link">
            <i class="fas fa-key me-2"></i> Ganti Password
        </a>
    </div>
</div>