<?php
require('koneksi.php');

$sql = "SELECT p.Kategori_Produk kategori, 
        t.Bulan as bulan,
       sum(f.Total_Penjualan) as TotalPenjualan 
    FROM dim_produk p, fakta_penjualan f, dim_waktu t 
WHERE (p.ID_Produk = f.ID_Produk) AND (t.id_waktu = f.id_waktu) 
GROUP BY kategori, bulan";

$result = mysqli_query($conn, $sql);

$penjualan = array();

while ($row = mysqli_fetch_array($result)) {
    array_push($penjualan, array(
        "TotalPenjualan" => $row['TotalPenjualan'],
        "bulan" => $row['bulan'],
        "kategori" => $row['kategori']
    ));
}

$data2 = json_encode($penjualan);
