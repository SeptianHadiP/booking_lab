<div class="overflow-x-auto p-5 relative">
    <table id="scheduleTable" class="w-full border-collapse text-sm">
        <thead>
            <tr class="bg-gradient-to-r from-indigo-500 to-blue-600 text-white text-center">
                <th class="w-10 px-3 py-2 font-semibold">No</th>
                <th class="px-3 py-2 font-semibold">Nama Dosen</th>
                <th class="min-w-[150px] px-3 py-2 font-semibold">Kelas</th>
                <th class="min-w-[150px] px-3 py-2 font-semibold">Tanggal</th>
                <th class="w-20 px-3 py-2 font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($schedules as $schedule)
                <tr class="hover:bg-gray-50 even:bg-gray-50/50 transition-colors relative">
                    <td class="text-center px-3 py-2">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-3 py-2">
                        <span class="font-medium text-gray-800">{{ $schedule->user->name ?? 'Tidak ada data' }}</span>
                    </td>
                    <td class="px-3 py-2">
                        <span class="text-gray-800">{{ $schedule->mata_kuliah_praktikum->nama_mata_kuliah ?? 'Mata kuliah tidak ditemukan' }}</span><br>
                        <span class="text-xs text-gray-500">{{ $schedule->kelas->nama_kelas ?? '-' }}</span>
                    </td>
                    <td class="px-3 py-2">
                        <span class="text-gray-800">{{ \Carbon\Carbon::parse($schedule->tanggal_praktikum)->format('d M Y') }}</span><br>
                        <span class="text-xs text-gray-500">{{ $schedule->waktu_praktikum }}</span>
                    </td>
                    <td class="px-3 py-2 text-center">
                        @role('aslab')
                            @if ($schedule->documentation)
                                <a href="{{ route('documentations.show', $schedule->documentation->id) }}"
                                   class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 transition">
                                    <i class="fa fa-eye"></i> Lihat
                                </a>
                            @else
                                <a href="{{ route('documentations.create', $schedule->id) }}"
                                   class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-white bg-green-500 rounded-md hover:bg-green-600 transition">
                                    <i class="fa fa-plus"></i> Dokumentasi
                                </a>
                            @endif
                        @else
                            <div class="relative inline-block text-left">
                                <button type="button"
                                        class="p-1.5 rounded-full hover:bg-gray-100 focus:outline-none"
                                        onclick="toggleDropdown(this)">
                                    <i class="fa fa-ellipsis-v text-gray-600"></i>
                                </button>
                                <div class="dropdown-menu absolute right-0 z-50 hidden w-40 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg">
                                    <div class="py-1">
                                        <a href="{{ route('schedulings.show', $schedule->id) }}"
                                           class="flex items-center px-3 py-2 text-xs text-gray-700 hover:bg-gray-50">
                                            <i class="fa fa-eye text-blue-500 mr-2"></i> Lihat
                                        </a>
                                        <a href="{{ route('schedulings.edit', $schedule->id) }}"
                                           class="flex items-center px-3 py-2 text-xs text-gray-700 hover:bg-gray-50">
                                            <i class="fa fa-pencil text-yellow-500 mr-2"></i> Edit
                                        </a>
                                        <button type="button"
                                                onclick="confirmDelete('{{ $schedule->id }}')"
                                                class="flex w-full items-center px-3 py-2 text-xs text-red-600 hover:bg-gray-50">
                                            <i class="fa fa-trash mr-2"></i> Hapus
                                        </button>
                                        <form id="delete-form-{{ $schedule->id }}" action="{{ route('schedulings.destroy', $schedule->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="{{ route('documentations.create', $schedule->id) }}"
                                           class="flex items-center px-3 py-2 text-xs text-gray-700 hover:bg-gray-50">
                                            <i class="fa fa-camera text-green-500 mr-2"></i> Dokumentasi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endrole
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-3 py-4 text-center text-gray-500">Belum ada data jadwal.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
function toggleDropdown(button) {
    document.querySelectorAll('.dropdown-menu').forEach(el => el.classList.add('hidden'));
    const dropdown = button.nextElementSibling;
    dropdown.classList.toggle('hidden');
}

window.addEventListener('click', function(e) {
    if (!e.target.closest('.relative')) {
        document.querySelectorAll('.dropdown-menu').forEach(el => el.classList.add('hidden'));
    }
});
</script>

<style>
/* Fix dropdown ketutup DataTable scroll */
div.dataTables_wrapper {
    overflow: visible !important;
}
table.dataTable {
    overflow: visible !important;
}
</style>
