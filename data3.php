<?php
require 'koneksi.php';

$sql = "SELECT d.Tahun, SUM(f.Total_Penjualan) AS TotalPenjualan
FROM Fakta_Penjualan f
JOIN Dim_Waktu d ON f.ID_Waktu = d.ID_Waktu
GROUP BY d.Tahun
ORDER BY d.Tahun;
";

$result = mysqli_query($conn,$sql);

$penjualan = [];

while ($row = mysqli_fetch_array($result)) {
    array_push($penjualan, [
        "TotalPenjualan" => $row['TotalPenjualan'],
        "Tahun" => $row['Tahun']
    ]);
}

$data3 = json_encode($penjualan);

?>