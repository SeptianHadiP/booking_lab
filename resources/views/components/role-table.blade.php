<div class="table-responsive">
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
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light border-0" type="button" data-bs-toggle="dropdown">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="{{ route('roles.show', $role->id) }}" class="dropdown-item">
                                        <i class="fa fa-eye text-primary me-2"></i> Lihat
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('roles.edit', $role->id) }}" class="dropdown-item">
                                        <i class="fa fa-pencil text-warning me-2"></i> Edit
                                    </a>
                                </li>
                                <li>
                                    <button class="dropdown-item text-danger" onclick="confirmDelete('{{ $role->id }}')">
                                        <i class="fa fa-trash me-2"></i> Hapus
                                    </button>
                                    <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </li>
                            </ul>
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
</div>
