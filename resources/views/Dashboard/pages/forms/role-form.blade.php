<form action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}" method="POST">
    @csrf
    @if (isset($role))
        @method('PUT')
    @endif

    {{-- Input Nama Role --}}
    <div class="mb-3">
        <label for="name" class="form-label">Nama Role</label>
        <input
            type="text"
            name="name"
            id="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $role->name ?? '') }}"
            placeholder="Masukkan nama role"
            required
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Permissions --}}
    <div class="mb-4">
        <label class="form-label">Permissions</label>
        <div class="row">
            @forelse ($permissions as $permission)
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input
                            type="checkbox"
                            class="form-check-input"
                            name="permissions[]"
                            value="{{ $permission->name }}"
                            id="permission-{{ $permission->id }}"
                            {{ (isset($role) && $role->permissions->pluck('name')->contains($permission->name)) || in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="permission-{{ $permission->id }}">
                            {{ $permission->name }}
                        </label>
                    </div>
                </div>
            @empty
                <p class="text-muted">Tidak ada permission tersedia.</p>
            @endforelse
        </div>
    </div>

    {{-- Tombol --}}
    <div class="d-flex justify-content-between flex-wrap gap-2">
        <a href="{{ route('roles.index') }}" class="btn btn-light border d-flex align-items-center shadow-sm px-3">
            <i class="fa fa-arrow-left me-2 text-secondary"></i>
            <span class="text-secondary fw-semibold">Batal</span>
        </a>

        <button type="submit" class="btn btn-primary d-flex align-items-center px-4 shadow-sm">
            <i class="fa {{ isset($role) ? 'fa-save' : 'fa-paper-plane' }} me-2"></i>
            <span>{{ isset($role) ? 'Update' : 'Simpan' }}</span>
        </button>
    </div>
</form>
