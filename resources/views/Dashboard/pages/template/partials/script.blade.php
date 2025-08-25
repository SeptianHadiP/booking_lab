@push('scripts')
<script>
    function toggleInput(select, inputId) {
        const input = document.getElementById(inputId);
        if (!input) return;
        input.classList.toggle('d-none', select.value !== 'custom');
        updatePreviewPosition();
    }

    document.addEventListener("DOMContentLoaded", function () {
        const colorPicker = document.querySelector('input[name="font_color"]');
        if(colorPicker) {
            colorPicker.addEventListener('input', updatePreviewColor);
        }

        const fileInput = document.querySelector('input[name="template_file"]');
        if(fileInput) {
            fileInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (evt) {
                        const img = document.getElementById('bg-preview');
                        img.src = evt.target.result;
                        img.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        const selects = document.querySelectorAll('select[name$="_x_type"], select[name$="_y_type"]');
        selects.forEach(select => select.addEventListener('change', updatePreviewPosition));

        const inputs = document.querySelectorAll('input[name$="_x"], input[name$="_y"]');
        inputs.forEach(input => input.addEventListener('input', updatePreviewPosition));

        // Jalankan toggleInput pada semua select saat load agar input number muncul jika 'custom'
        selects.forEach(select => {
            toggleInput(select, select.getAttribute('name').replace('_type', ''));
        });

        function updatePreviewColor() {
            const color = colorPicker.value;
            ['preview-name', 'preview-score', 'preview-desc'].forEach(id => {
                const el = document.getElementById(id);
                if(el) el.style.color = color;
            });
        }

        // Fungsi untuk menentukan posisi dan transform sesuai tipe posisi
        function setPositionAndTransform(el, xType, xVal, yType, yVal) {
            if(!el) return;

            if(xType === 'center') {
                el.style.left = '50%';
            } else {
                el.style.left = (parseInt(xVal) || 0) + 'px';
            }

            if(yType === 'center') {
                el.style.top = '50%';
            } else {
                el.style.top = (parseInt(yVal) || 0) + 'px';
            }

            // Jika salah satu axis center, pakai translate(-50%, -50%), kalau custom posisi tanpa translate
            if(xType === 'center' || yType === 'center') {
                el.style.transform = 'translate(-50%, -50%)';
            } else {
                el.style.transform = 'none';
            }
        }

        function updatePreviewPosition() {
            const previewWidth = 1123;
            const previewHeight = 794;

            ['name', 'score', 'desc'].forEach(prefix => {
                const xTypeEl = document.querySelector(`[name="${prefix}_x_type"]`);
                const yTypeEl = document.querySelector(`[name="${prefix}_y_type"]`);
                const xEl = document.querySelector(`[name="${prefix}_x"]`);
                const yEl = document.querySelector(`[name="${prefix}_y"]`);
                const previewEl = document.getElementById(`preview-${prefix}`);

                if (!xTypeEl || !yTypeEl || !xEl || !yEl || !previewEl) return;

                const xType = xTypeEl.value;
                const yType = yTypeEl.value;
                const x = xEl.value;
                const y = yEl.value;

                setPositionAndTransform(previewEl, xType, x, yType, y);
            });
        }

        // Set ukuran font hanya sekali saat load, jangan update terus supaya ukuran font konsisten
        function setInitialFontSize() {
            const name = document.getElementById('preview-name');
            const score = document.getElementById('preview-score');
            const desc = document.getElementById('preview-desc');

            if(name) {
                name.style.fontSize = '40px';
                name.style.fontWeight = 'bold';
            }
            if(score) {
                score.style.fontSize = '30px';
                score.style.fontWeight = 'bold';
            }
            if(desc) {
                desc.style.fontSize = '20px';
                desc.style.fontWeight = 'bold';
            }
        }

        updatePreviewColor();
        updatePreviewPosition();
        setInitialFontSize();
    });
</script>
@endpush
