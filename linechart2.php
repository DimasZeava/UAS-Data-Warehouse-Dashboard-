<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard WHAdventureWorks</title>

    <!-- Custom fonts for this template -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

</head>

<body id="page-top">

    <?php
    include 'data7.php';

    // Decode JSON data from `data7.php`
    $data7 = json_decode($data7, TRUE);

    // Check if data is valid
    if (!$data7) {
        echo '<p>Data tidak valid atau tidak tersedia.</p>';
        exit;
    }

    // Prepare data for the chart
    $years = [];
    $paymentData = [];

    foreach ($data7 as $entry) {
        $year = $entry['Tahun'];
        $payment = $entry['Pembayaran'];
        $total = $entry['TotalPenjualan'];

        $years[$year] = $year; // Collect unique years
        $paymentData[$payment][$year] = (float)$total; // Store total sales by payment method and year
    }

    // Fill missing years with zero sales
    $years = array_values($years); // Get sorted years
    foreach ($paymentData as $payment => &$data) {
        $data = array_replace(array_fill_keys($years, 0), $data); // Ensure all years have a value
    }
    unset($data); // Break reference
    ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sidebar.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <p class="highcharts-description">
                    Berikut merupakan grafik untuk menampilkan penjualan berdasarkan metode pembayaran tiap tahunnya pada data AdventureWorks.
                </p>
                <div id="linechart" class="grafik"></div>

                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Dashboard WHAdventureWorks</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Highcharts Script -->
    <script type="text/javascript">
        Highcharts.chart('linechart', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Grafik Penjualan Berdasarkan Metode Pembayaran'
            },
            subtitle: {
                text: 'Source: Database WHSakila2021'
            },
            xAxis: {
                categories: <?= json_encode($years); ?> // X-axis years
            },
            yAxis: {
                title: {
                    text: 'Total Penjualan'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                }
            },
            series: [
                <?php foreach ($paymentData as $payment => $data): ?> {
                        name: '<?= $payment; ?>',
                        data: <?= json_encode(array_values($data)); ?> // Data for each payment method
                    },
                <?php endforeach; ?>
            ]
        });
    </script>

    <!-- Bootstrap core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/js/sb-admin-2.min.js"></script>

</body>

</html>