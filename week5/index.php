<!DOCTYPE html>
<html>
<head>
    <title>Tabel Warna</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h4>162023043 - Karin Khairinissa</h4>

<table>
<?php
$warna = ["merah","kuning","hijau","biru","coklat"];

for($baris = 1; $baris <= 5; $baris++){
    echo "<tr>";
    
    for($kolom = 1; $kolom <= 5; $kolom++){
        echo "<td class='".$warna[$baris-1]."'>$baris,$kolom</td>";
    }

    echo "</tr>";
}
?>
</table>

</body>
</html>