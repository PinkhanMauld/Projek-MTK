<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Bunga</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Kalkulator Bunga</h1>
        <form action="calculate.php" method="POST">
            <label for="jenisBunga">Jenis Bunga:</label>
            <select id="jenisBunga" name="jenisBunga">
                <option value="tunggal">Bunga Tunggal</option>
                <option value="majemuk">Bunga Majemuk</option>
            </select>

            <label for="jumlah">Jumlah Pokok (Rp):</label>
            <input type="number" id="jumlah" name="jumlah" required>

            <label for="sukuBunga">Suku Bunga (% per tahun):</label>
            <input type="number" id="sukuBunga" name="sukuBunga" step="0.01" required>

            <label for="time">Waktu (tahun):</label>
            <input type="number" id="time" name="time" required>

            <label for="compound">Frekuensi Penggabungan (untuk bunga majemuk):</label>
            <input type="number" id="compound" name="compound" placeholder="Misalnya, 4 untuk kuartalan">

            <button type="submit">Hitung Bunga</button>
        </form>
    </div>
 
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $jenisBunga = $_POST['jenisBunga'];
    $jumlah = $_POST['jumlah'];
    $sukuBunga = $_POST['sukuBunga'] / 100;
    $time = $_POST['time'];
    $compound = isset($_POST['compound']) ? $_POST['compound'] : 1;

    if ($jenisBunga == "tunggal") {
        // Hitung Bunga Tunggal
        $bunga = $jumlah * $sukuBunga * $time;
        $total = $jumlah + $bunga;
        echo "<div class='output-container'>";
        echo "<h1>Hasil Perhitungan Bunga Tunggal</h1>";
        echo "Jumlah Pokok:<b> Rp." . number_format($jumlah, 0, ",", ".") . "<br></b>";
        echo "Suku Bunga: <b>" . ($sukuBunga * 100) . "% / tahun<br></b>";
        echo "Waktu: <b>" . $time . " tahun<br></b>";
        echo "Bunga:<b> Rp." . number_format($bunga, 0, ",", ".") . "<br></b>";
        echo "Total:<b> Rp " . number_format($total, 2) . "<br></b>";
        echo "</div>";
    } elseif ($jenisBunga == "majemuk") {
        // Hitung Bunga Majemuk
        $total = $jumlah * pow((1 + $sukuBunga / $compound), $compound * $time);
        $bunga = $total - $jumlah;
        echo "<div class='output-container'>";
        echo "<h1>Hasil Perhitungan Bunga Majemuk</h1>";
        echo "Jumlah Pokok: Rp " . number_format($jumlah, 2) . "<br>";
        echo "Suku Bunga: " . ($sukuBunga * 100) . "% per tahun<br>";
        echo "Waktu: " . $time . " tahun<br>";
        echo "Frekuensi Penggabungan: " . $compound . "<br>";
        echo "Bunga: Rp " . number_format($bunga, 2) . "<br>";
        echo "Total: Rp " . number_format($total, 2) . "<br>";
        echo "</div>";
    } else {
        echo "Jenis bunga tidak valid!";
    }
}
?>

</body>
</html>
