// =============================================
//  script.js - Digunakan di semua halaman
// =============================================


// --- TOAST ---

function showToast(type, msg) {
    var toast = document.getElementById('toast');
    if (!toast) return;

    toast.className = 'show ' + type;
    toast.textContent = msg;

    setTimeout(function () {
        toast.className = '';
    }, 3000);
}


// --- VALIDASI FORM CREATE & UPDATE ---

function validasiForm(formId) {
    var form     = document.getElementById(formId);
    if (!form) return;

    form.addEventListener('submit', function (e) {
        var usernameInput = document.getElementById('username');
        var emailInput    = document.getElementById('email');
        var username      = usernameInput.value.trim();
        var email         = emailInput.value.trim();
        var emailRegex    = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        usernameInput.classList.remove('invalid');
        emailInput.classList.remove('invalid');

        if (username === '' && email === '') {
            e.preventDefault();
            usernameInput.classList.add('invalid');
            emailInput.classList.add('invalid');
            showToast('error', 'Username dan email tidak boleh kosong.');
            return;
        }

        if (username === '') {
            e.preventDefault();
            usernameInput.classList.add('invalid');
            showToast('error', 'Username tidak boleh kosong.');
            return;
        }

        if (email === '') {
            e.preventDefault();
            emailInput.classList.add('invalid');
            showToast('error', 'Email tidak boleh kosong.');
            return;
        }

        if (!emailRegex.test(email)) {
            e.preventDefault();
            emailInput.classList.add('invalid');
            showToast('error', 'Format email tidak valid.');
            return;
        }
    });
}


// --- MODAL KONFIRMASI DELETE ---

var deleteId = null;

function confirmDelete(id, name) {
    deleteId = id;
    var text = document.getElementById('modalText');
    if (text) {
        text.textContent = 'Yakin ingin menghapus "' + name + '"?';
    }
    document.getElementById('deleteModal').classList.add('open');
}

function closeModal() {
    document.getElementById('deleteModal').classList.remove('open');
    deleteId = null;
}

function initDeleteModal() {
    var confirmBtn = document.getElementById('confirmDelBtn');
    if (!confirmBtn) return;

    confirmBtn.addEventListener('click', function () {
        if (!deleteId) return;

        fetch('delete.php?id=' + deleteId)
            .then(function (r) { return r.json(); })
            .then(function (data) {
                closeModal();
                if (data.success) {
                    showToast('success', data.message);
                    setTimeout(function () { location.reload(); }, 1200);
                } else {
                    showToast('error', data.message);
                }
            })
            .catch(function () {
                showToast('error', 'Terjadi kesalahan pada server.');
            });
    });

    // Tutup modal klik di luar
    document.getElementById('deleteModal').addEventListener('click', function (e) {
        if (e.target === this) closeModal();
    });
}


// --- INISIALISASI BERDASARKAN HALAMAN ---

document.addEventListener('DOMContentLoaded', function () {

    // Jalankan validasi form jika ada
    validasiForm('createForm');
    validasiForm('updateForm');

    // Jalankan modal delete jika ada
    initDeleteModal();

    // Tampilkan toast dari PHP jika ada
    if (typeof phpMessage !== 'undefined' && phpMessage !== '') {
        showToast(phpType, phpMessage);
    }

    // Toast setelah redirect update berhasil
    var params = new URLSearchParams(location.search);
    if (params.get('updated') === '1') {
        showToast('success', 'Data berhasil diperbarui!');
        history.replaceState(null, '', location.pathname);
    }

});