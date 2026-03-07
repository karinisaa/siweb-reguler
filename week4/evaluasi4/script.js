$(document).ready(function () {

  /* ============================================================
     BUILD LOGO BACKGROUND PATTERN
  ============================================================ */
  var logoSrc = $('#logo-hidden').attr('src');
  var bg = $('#logo-bg');
  for (var i = 0; i < 250; i++) {
    bg.append($('<img>').attr('src', logoSrc).attr('alt', ''));
  }

  /* ============================================================
     NAVIGATION
  ============================================================ */
  function showPage(name) {
    $('#page-home, #page-menu').hide();
    $('#page-calc').removeClass('active-page').hide();
    $('nav a').removeClass('active');
    $('nav a[data-page="' + name + '"]').addClass('active');
    if (name === 'calc') {
      $('#page-calc').addClass('active-page').show();
    } else {
      $('#page-' + name).show();
    }
  }

  $('nav a[data-page]').on('click', function (e) {
    e.preventDefault();
    var page = $(this).data('page');

    if (page === 'home') {
      showPage('home');

    } else if (page === 'menu') {
      // First alert prompt
      alert('input jumlah pesanan agar dihitung otomatis oleh sistem');
      showPage('menu');

    } else if (page === 'calc') {
      showPage('calc');
    }
  });

  /* ============================================================
     HOME — SHOUT BUTTON
  ============================================================ */
  $('#btn-shout').on('click', function () {
    alert('Hai, Selamat datang di Sistem Sederhana');
  });

  /* ============================================================
     MENU — ORDER TABLE
  ============================================================ */
  var menuItems = [
    { no: 1, name: 'Bakso Istimewa', price: 12000 },
    { no: 2, name: 'Soto Spesial',   price: 10000 },
    { no: 3, name: 'Mie Ayam Super', price: 15000 }
  ];

  // Build menu table rows
  var tbody = $('#menu-tbody');
  menuItems.forEach(function (item, idx) {
    var tr = $('<tr>');
    tr.append($('<td>').text(item.no));
    tr.append($('<td>').text(item.name));
    tr.append($('<td>').addClass('harga').html('&#9400; Rp ' + item.price.toLocaleString('id-ID')));
    var tdPesan = $('<td>');
    var inp = $('<input>')
      .attr('type', 'number')
      .attr('min', '0')
      .attr('value', '0')
      .addClass('qty-input')
      .data('price', item.price);
    tdPesan.append(inp);
    // Tombol Reset di samping input baris ke-3 (index 2)
    if (idx === 2) {
      var btnReset = $('<button>')
        .addClass('btn-reset-menu')
        .attr('id', 'btn-reset-menu')
        .text('Reset');
      tdPesan.append(' ').append(btnReset);
    }
    tr.append(tdPesan);
    tbody.append(tr);
  });

  function hitungTotal() {
    var total = 0;
    $('.qty-input').each(function () {
      var qty = parseInt($(this).val()) || 0;
      var price = $(this).data('price');
      total += qty * price;
    });

    var diskon = 0;
    if (total > 50000) {
      diskon = Math.round(total * 0.1);
    }
    var bayar = total - diskon;

    $('#out-total').val(total.toLocaleString('id-ID'));
    $('#out-diskon').val(diskon.toLocaleString('id-ID'));
    $('#out-bayar').val(bayar.toLocaleString('id-ID'));
  }

  // Live update on qty change
  $(document).on('input change', '.qty-input', function () {
    hitungTotal();
  });

  // Reset menu
  $(document).on('click', '#btn-reset-menu', function () {
    $('.qty-input').val(0);
    hitungTotal();
  });

  // Init totals
  hitungTotal();

  /* ============================================================
     CALCULATOR
  ============================================================ */
  $('#btn-hitung').on('click', function () {
    var a = $('#calc-a').val().trim();
    var b = $('#calc-b').val().trim();
    var op = $('#calc-op').val();

    if (a === '' || b === '') {
      alert('inputan pertama dan kedua harus lebih dari 0');
      return;
    }

    var numA = parseFloat(a);
    var numB = parseFloat(b);
    var result;

    switch (op) {
      case '+': result = numA + numB; break;
      case '-': result = numA - numB; break;
      case '*': result = numA * numB; break;
      case '/':
        if (numB === 0) { alert('Pembagi tidak boleh 0'); return; }
        result = numA / numB;
        break;
      case '%': result = numA % numB; break;
      case '^': result = Math.pow(numA, numB); break;
      default: result = 0;
    }

    // Round to max 6 decimal places
    result = parseFloat(result.toFixed(6));
    $('#calc-result').val(result);
  });

  $('#btn-reset-calc').on('click', function () {
    $('#calc-a').val('');
    $('#calc-b').val('');
    $('#calc-op').val('+');
    $('#calc-result').val('');
  });

  /* ============================================================
     INIT — show home on load
  ============================================================ */
  showPage('home');
});