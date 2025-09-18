<form
    action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}"
    method="POST"
    class="space-y-6"
>
    @csrf
    @if (isset($role))
        @method('PUT')
    @endif

    {{-- Nama Role --}}
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
            Nama Role
        </label>
        <input
            type="text"
            name="name"
            id="name"
            value="{{ old('name', $role->name ?? '') }}"
            placeholder="Masukkan nama role"
            required
            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm
                   focus:border-blue-500 focus:ring focus:ring-blue-200
                   @error('name') border-red-500 @enderror"
        >
        @error('name')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Permissions --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Permissions
        </label>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
            @forelse ($permissions as $permission)
                <label for="permission-{{ $permission->id }}" class="inline-flex items-center space-x-2">
                    <input
                        type="checkbox"
                        name="permissions[]"
                        id="permission-{{ $permission->id }}"
                        value="{{ $permission->name }}"
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring focus:ring-blue-200"
                        {{ (isset($role) && $role->permissions->pluck('name')->contains($permission->name))
                            || in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}
                    >
                    <span class="text-gray-700">{{ $permission->name }}</span>
                </label>
            @empty
                <p class="text-sm text-gray-400">Tidak ada permission tersedia.</p>
            @endforelse
        </div>
    </div>

    {{-- Tombol --}}
    <div class="flex flex-wrap justify-between gap-3">
        <a href="{{ route('roles.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 text-gray-700 rounded shadow-sm hover:bg-gray-200 transition">
            <i class="fa fa-arrow-left mr-2 text-gray-500"></i>
            <span class="font-semibold">Batal</span>
        </a>

        <button type="submit"
                class="inline-flex items-center px-5 py-2 bg-blue-600 text-white rounded shadow-sm hover:bg-blue-700 transition">
            <i class="fa {{ isset($role) ? 'fa-save' : 'fa-paper-plane' }} mr-2"></i>
            <span>{{ isset($role) ? 'Update' : 'Simpan' }}</span>
        </button>
    </div>
</form>
