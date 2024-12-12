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

// $sql1 = "SELECT f.kategori kategori, 
//         t.bulan as bulan,
//        COUNT(fp.film_id) as pendapatan 
//     FROM film f, fakta_pendapatan fp, time t 
// WHERE (f.film_id = fp.film_id) AND (t.time_id = fp.time_id) 
// GROUP BY kategori, bulan";

// $result1 = mysqli_query($conn,$sql1);

// $pendapatan = array();

// while ($row = mysqli_fetch_array($result1)) {
//     array_push($pendapatan,array(
//         "pendapatan"=>$row['pendapatan'],
//         "bulan" => $row['bulan'],
//         "kategori" => $row['kategori']
//     ));
// }

// $data3 = json_encode($pendapatan);

?>