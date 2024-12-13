<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard WHAdventureWorks</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/styleGraph.css">
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

</head>

<body id="page-top">

<?php 
//data barchart
include 'data5.php';
include 'data6.php';

$data5 = json_decode($data5, TRUE);
?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sidebar.php";?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                
                <div id="container" class="grafik"></div>
                <p class="highcharts-description">
                Berikut merupakan grafik untuk menampilkan kategori film terlaris pada rental film Sakila.
                </p>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Dashboard WHSakila2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script type="text/javascript">
    // Persiapkan data seri dari PHP
    const dataWilayah = <?php echo json_encode($data5); ?>;

    // Proses data menjadi format untuk Highcharts
    const seriesData = {};

    dataWilayah.forEach(item => {
        const wilayah = item.Wilayah;
        const tahun = item.Tahun;
        const persen = parseFloat(item.PersentasePeningkatan) || 0;

        if (!seriesData[wilayah]) {
            seriesData[wilayah] = [];
        }
        seriesData[wilayah].push([tahun, persen]);
    });

    const series = Object.keys(seriesData).map(wilayah => ({
        name: wilayah,
        data: seriesData[wilayah].sort((a, b) => a[0] - b[0]) // Urutkan data berdasarkan tahun
    }));

    // Render line chart
    Highcharts.chart('container', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Persentase Peningkatan Penjualan Tahunan di Berbagai Wilayah'
        },
        subtitle: {
            text: 'Source: Database WHAdventureWorks'
        },
        xAxis: {
            title: {
                text: 'Tahun'
            },
            type: 'category',
            labels: {
                format: '{value}'
            }
        },
        yAxis: {
            title: {
                text: 'Persentase Peningkatan (%)'
            },
            labels: {
                format: '{value}%'
            }
        },
        tooltip: {
            shared: true,
            crosshairs: true,
            pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y:.2f}%</b><br/>'
        },
        series: series,
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{y:.2f}%'
                }
            }
        }
    });
</script>


    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/js/sb-admin-2.min.js"></script>


</body>

</html>