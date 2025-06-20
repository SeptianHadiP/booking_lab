@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 fw-semibold text-dark mb-1">Buat Role</h2>
            <p class="text-muted small mb-0">Masukkan informasi role dan hak akses</p>
        </div>
        <a href="{{ route('roles.index') }}" class="btn btn-success">Kembali</a>
    </div>

    <form action="#" method="POST">
        @csrf

        <!-- Nama -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama role atau user" required>
        </div>

        <!-- Dynamic Role-Permission Form -->
        <div id="role-permission-wrapper">
            <div class="role-permission-set mb-4 border rounded p-3">
                <div class="mb-3">
                    <label class="form-label">Manage Role</label>
                    <select name="roles[0][manage_role]" class="form-select manage-role" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="User">User</option>
                        <option value="Schedule">Schedule</option>
                        <option value="Nilai">Nilai</option>
                    </select>
                </div>

                <div class="permissions mt-2" style="display: none;">
                    <label class="form-label">Permissions</label>
                    <div class="form-check">
                        <input type="checkbox" name="roles[0][permissions][]" value="view" class="form-check-input" id="view0">
                        <label class="form-check-label" for="view0">View</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="roles[0][permissions][]" value="create" class="form-check-input" id="create0">
                        <label class="form-check-label" for="create0">Create</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="roles[0][permissions][]" value="update" class="form-check-input" id="update0">
                        <label class="form-check-label" for="update0">Update</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="roles[0][permissions][]" value="delete" class="form-check-input" id="delete0">
                        <label class="form-check-label" for="delete0">Delete</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let wrapper = document.getElementById('role-permission-wrapper');
    let index = 1;

    function getSelectedRoles() {
        return Array.from(document.querySelectorAll('.manage-role'))
            .map(select => select.value)
            .filter(val => val !== '');
    }

    function updateDropdownOptions() {
        const selectedRoles = getSelectedRoles();
        const allRoles = ['User', 'Schedule', 'Nilai'];

        document.querySelectorAll('.manage-role').forEach(select => {
            const currentValue = select.value;
            select.innerHTML = `<option value="">-- Pilih Role --</option>`;

            allRoles.forEach(role => {
                if (!selectedRoles.includes(role) || role === currentValue) {
                    const opt = document.createElement('option');
                    opt.value = role;
                    opt.textContent = role;
                    if (role === currentValue) opt.selected = true;
                    select.appendChild(opt);
                }
            });
        });
    }

    function refreshFields() {
        updateDropdownOptions();

        const selectedRoles = getSelectedRoles();
        const allRoles = ['User', 'Schedule', 'Nilai'];

        const sets = wrapper.querySelectorAll('.role-permission-set');

        // Hapus field kosong kecuali yang terakhir
        sets.forEach((set, i) => {
            const select = set.querySelector('.manage-role');
            if (select.value === '' && i !== sets.length - 1) {
                wrapper.removeChild(set);
            }
        });

        const lastSelect = sets[sets.length - 1].querySelector('.manage-role');
        const lastValue = lastSelect.value;

        if (selectedRoles.length < allRoles.length && lastValue !== '') {
            const lastSet = sets[sets.length - 1];
            const newSet = lastSet.cloneNode(true);

            newSet.querySelectorAll('select, input').forEach(el => {
                if (el.name) el.name = el.name.replace(/\d+/, index);
                if (el.id) el.id = el.id.replace(/\d+/, index);
                if (el.type === 'checkbox') el.checked = false;
                if (el.tagName === 'SELECT') el.value = '';
            });

            newSet.querySelector('.permissions').style.display = 'none';
            wrapper.appendChild(newSet);
            index++;
            updateDropdownOptions(); // agar pilihan baru langsung disesuaikan
        }
    }

    wrapper.addEventListener('change', function (e) {
        if (e.target.classList.contains('manage-role')) {
            const parentSet = e.target.closest('.role-permission-set');
            const permBox = parentSet.querySelector('.permissions');

            permBox.style.display = e.target.value ? 'block' : 'none';

            refreshFields();
        }
    });

    // Inisialisasi awal
    refreshFields();
});
</script>
@endsection



