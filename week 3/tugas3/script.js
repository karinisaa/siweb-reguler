// 1. Ambil elemen yang kita butuhkan
const btnSimpan = document.getElementById('btnSimpan');
const bgInput = document.getElementById('bgInput');
const textInput = document.getElementById('textInput');

// 2. Pasang 'telinga' (event listener) di tombol Simpan
btnSimpan.addEventListener('click', function() {
    
    // a. Ambil nilai warna yang sudah dipilih user di kotak input
    const warnaLatarPilihan = bgInput.value;
    const warnaTeksPilihan = textInput.value;

    // b. Terapkan warna tersebut ke seluruh halaman (body)
    document.body.style.backgroundColor = warnaLatarPilihan;
    document.body.style.color = warnaTeksPilihan;
});