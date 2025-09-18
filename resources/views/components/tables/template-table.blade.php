<div class="table-responsive">
    <table id="templateTable" class="table table-bordered table-hover table-sm align-middle text-sm w-100">
        <thead class="table-light text-center">
            <tr>
                <th style="width: 40px;">No</th>
                <th>Nama Template</th>
                <th style="min-width: 150px;">Preview</th>
                <th style="width: 80px;">Warna Font</th>
                <th style="width: 80px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($templates as $template)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-start">{{ $template->name }}</td>
                        <td class="text-center">
                        <img src="{{ asset($template->file_path) }}" alt="Preview" style="height: 60px;">
                    </td>
                    <td class="text-center align-middle">
                        <div style="width: 30px; height: 30px; background: {{ $template->font_color ?? '#000' }}; border-radius: 5px; border: 1px solid #ddd; margin: 0 auto;"></div>
                    </td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="{{ route('template.edit', $template->id) }}" class="dropdown-item">
                                        <i class="fa fa-pencil text-warning me-2"></i> Edit
                                    </a>
                                </li>
                                <li>
                                    <button class="dropdown-item text-danger" onclick="confirmDelete('{{ $template->id }}')">
                                        <i class="fa fa-trash me-2"></i> Hapus
                                    </button>
                                    <form id="delete-form-{{ $template->id }}" action="{{ route('template.destroy', $template->id) }}" method="POST" style="display: none;">
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
                    <td colspan="5" class="text-center text-muted">Belum ada template sertifikat</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
