<!-- resources/views/components/role-table.blade.php -->
    <table id="roleTable" class="table table-bordered table-hover table-sm align-middle text-sm w-100">
        <thead class="table-light text-center">
            <tr>
                <th style="width: 40px;">No</th>
                <th>Nama Role</th>
                <th>Hak Akses</th>
                <th style="width: 80px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        @if($role->permissions->isNotEmpty())
                            @foreach($role->permissions as $permission)
                                <span class="badge bg-primary">{{ $permission->name }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="relative inline-block text-left">
                            <button type="button" class="p-2 rounded-full hover:bg-gray-200 focus:outline-none transition" onclick="toggleDropdown('role-{{ $role->id }}')">
                                <i class="bi bi-three-dots-vertical text-gray-600"></i>
                            </button>
                            <div id="dropdown-role-{{ $role->id }}" class="hidden absolute right-0 mt-2 w-44 bg-white rounded-lg shadow-lg ring-1 ring-gray-200 z-20">
                                <ul class="py-1 text-sm text-gray-700 divide-y divide-gray-100">
                                    <li>
                                        <a href="{{ route('roles.show', $role->id) }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-50">
                                            <i class="bi bi-eye text-blue-500"></i> Lihat
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('roles.edit', $role->id) }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-50">
                                            <i class="bi bi-pencil text-yellow-500"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="button" class="w-full flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-gray-50" onclick="confirmDelete('{{ $role->id }}')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Belum ada data role.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
