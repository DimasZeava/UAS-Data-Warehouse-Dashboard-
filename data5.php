<?php
require('koneksi.php');

$sql = "SELECT 
    w.Nama_Wilayah Wilayah, 
    d.Tahun, 
    SUM(f.Total_Penjualan) AS TotalPenjualan, 
    ROUND(
        CASE 
            WHEN LAG(SUM(f.Total_Penjualan)) OVER (PARTITION BY w.Nama_Wilayah ORDER BY d.Tahun) IS NULL THEN 0
            ELSE 
                (SUM(f.Total_Penjualan) - LAG(SUM(f.Total_Penjualan)) OVER (PARTITION BY w.Nama_Wilayah ORDER BY d.Tahun)) / 
                LAG(SUM(f.Total_Penjualan)) OVER (PARTITION BY w.Nama_Wilayah ORDER BY d.Tahun) * 100
        END, 2
    ) AS PersentasePeningkatan
FROM 
    Fakta_Penjualan f
JOIN 
    dim_Wilayah w ON f.ID_Wilayah = w.ID_Wilayah
JOIN 
    dim_Waktu d ON f.ID_Waktu = d.ID_Waktu
GROUP BY 
    w.Nama_Wilayah, d.Tahun
ORDER BY 
    d.Tahun;
";

$result = mysqli_query($conn, $sql);

$hasil = array();

while ($row = mysqli_fetch_assoc($result)) {
    array_push($hasil, array(
        "Wilayah" => $row['Wilayah'],
        "Tahun" => $row['Tahun'],
        "TotalPenjualan" => $row['TotalPenjualan'],
        "PersentasePeningkatan" => $row['PersentasePeningkatan']
    ));
}

$data5 = json_encode($hasil);
