<?php
require('koneksi.php');

$sql = "SELECT b.Metode_Pembayaran AS Pembayaran, d.Tahun, SUM(f.Total_Penjualan) AS TotalPenjualan
FROM Fakta_Penjualan f
JOIN Dim_Pembayaran b ON f.ID_Pembayaran = b.ID_Pembayaran
JOIN Dim_Waktu d ON f.ID_Waktu = d.ID_Waktu
GROUP BY b.Metode_Pembayaran, d.Tahun
ORDER BY d.Tahun;
";

$result = mysqli_query($conn, $sql);

$penjualan = [];

while ($row = mysqli_fetch_array($result)) {
    array_push($penjualan, array(
        "TotalPenjualan" => $row['TotalPenjualan'],
        "Tahun" => $row['Tahun'],
        "Pembayaran" => $row['Pembayaran']
    ));
}
$data7 = json_encode($penjualan);

?>