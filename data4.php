<?php
require('koneksi.php');

$sql = "SELECT p.Tipe_Pelanggan kategori, 
        t.bulan as bulan,
        COUNT(DISTINCT(f.ID_Pelanggan)) as pelanggan 
        FROM dim_pelanggan p, fakta_penjualan f, dim_waktu t 
        WHERE (p.ID_Pelanggan = f.ID_Pelanggan) AND (t.ID_Waktu = f.ID_Waktu) 
        GROUP BY kategori, bulan";
$result = mysqli_query($conn,$sql);

$hasil = array();

while ($row = mysqli_fetch_array($result)) {
    array_push($hasil,array(
        "kategori"=>$row['kategori'],
        "bulan"=>$row['bulan'],
        "pelanggan"=>$row['pelanggan']
    ));
}

$data4 = json_encode($hasil);
?>