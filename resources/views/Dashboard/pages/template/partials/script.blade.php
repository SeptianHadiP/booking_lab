<!-- resources/views/dashboard/pages/template/partials/script.blade.php -->
<script>
function toggleInput(select, inputId) {
    const input = document.getElementById(inputId);
    if (!input) return;
    input.classList.toggle('hidden', select.value !== 'custom');
    updatePreviewPosition();
}

document.addEventListener("DOMContentLoaded", function () {
    const colorPicker = document.querySelector('input[name="font_color"]');
    const fileInput = document.querySelector('input[name="template_file"]');

    // Update font color hanya untuk Nama
    if(colorPicker) {
        colorPicker.addEventListener('input', () => {
            const nameEl = document.getElementById('preview-name');
            if(nameEl) nameEl.style.color = colorPicker.value;
        });
    }

    // Update background image
    if(fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if(file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    const img = document.getElementById('bg-preview');
                    img.src = evt.target.result;
                    img.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Delegated event listener untuk semua input/select posisi
    document.addEventListener('input', function(e) {
        if(e.target.matches('input[name$="_x"], input[name$="_y"]')) {
            updatePreviewPosition();
        }
    });
    document.addEventListener('change', function(e) {
        if(e.target.matches('select[name$="_x_type"], select[name$="_y_type"]')) {
            toggleInput(e.target, e.target.name.replace('_type',''));
            updatePreviewPosition();
        }
    });

    // Set ukuran font preview
    const sizes = {'preview-name':40,'preview-score':30,'preview-desc':20};
    Object.keys(sizes).forEach(id => {
        const el = document.getElementById(id);
        if(el) {
            el.style.fontSize = sizes[id]+'px';
            el.style.fontWeight = 'bold';
        }
    });

    // Fungsi untuk set posisi
    function setPositionAndTransform(el, xType, xVal, yType, yVal) {
        if(!el) return;
        el.style.left = xType==='center' ? '50%' : (parseInt(xVal)||0)+'px';
        el.style.top = yType==='center' ? '50%' : (parseInt(yVal)||0)+'px';
        el.style.transform = (xType==='center'||yType==='center') ? 'translate(-50%, -50%)' : 'none';
    }

    // Fungsi update preview
    window.updatePreviewPosition = function() {
        ['name','score','desc'].forEach(prefix => {
            const xTypeEl = document.querySelector(`[name="${prefix}_x_type"]`);
            const yTypeEl = document.querySelector(`[name="${prefix}_y_type"]`);
            const xEl = document.querySelector(`[name="${prefix}_x"]`);
            const yEl = document.querySelector(`[name="${prefix}_y"]`);
            const previewEl = document.getElementById(`preview-${prefix}`);
            if (!xTypeEl || !yTypeEl || !xEl || !yEl || !previewEl) return;

            setPositionAndTransform(previewEl, xTypeEl.value, xEl.value, yTypeEl.value, yEl.value);
        });
    };

    // Jalankan sekali saat load
    updatePreviewPosition();
});
</script>
