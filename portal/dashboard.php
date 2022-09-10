<?php
    require_once "../assets/includes/sessions.php";
    auth();

$currUser = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Earlycode Blog</title>
    <link href="../assets/img/logo.png" rel="shortcut icon" />
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/fontawsome/css/all.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav">
        <?php include "../assets/includes/dashnav.php"; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <?php echo success_msg(); echo error_msg();?>



                    <div class="card">
                        <h3>Total Sales</h3>
                        <div id="chart"></div>
                    </div>
                </div>
            </main>
            <!-- Footer -->
            <?php require "../assets/includes/dashfoot.php"; ?>
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
            <script>
                var options = {
                chart: {
                    type: 'bar'
                },
                series: [{
                    name: 'sales',
                    data: [30,40,35,50,49,60,70,91,125]
                }],
                xaxis: {
                    categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
                }
                }

                var chart = new ApexCharts(document.querySelector("#chart"), options);

                chart.render();
            </script>
        </div>
    </div>
</body>
</html>