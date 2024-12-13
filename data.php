<?php
require('koneksi.php');

$sql = "SELECT w.Nama_Wilayah wilayah, 
               p.Kategori_Produk kategori,
               SUM(f.Total_Penjualan) AS total
        FROM dim_wilayah w, fakta_penjualan f, dim_produk p
        WHERE w.ID_Wilayah = f.ID_Wilayah AND p.ID_Produk = f.ID_Produk
        GROUP BY w.Nama_Wilayah, p.Kategori_Produk";
$result = mysqli_query($conn, $sql);

$hasil = array();

while ($row = mysqli_fetch_array($result)) {
    array_push($hasil, array(
        "wilayah" => $row['wilayah'],
        "kategori" => $row['kategori'],
        "total" => $row['total']
    ));
}

$data = json_encode($hasil);

?>