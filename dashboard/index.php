<?php
//echo PHP_VERSION;
if ($_COOKIE['api_key'] == '') {
    header("Location: ../login?logout=1");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard</title>

    <link rel="icon" type="image/png" sizes="16x16" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRnMsya0otsTJNljvhBeSxgDTZojQfRS1D3TA&s">
    <link href="../vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/chartist/css/chartist.min.css">

    <link href="../vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="../vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
</head>
<style>
    .error {
        color: red;
    }
</style>

<body>


    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>




    <div id="main-wrapper">


        <?php
        date_default_timezone_set("Asia/Kolkata");
        include('../includes/connection.php');


        $sqlVendorC = "SELECT COUNT(id) as count FROM vendor";
        $resultVendorC = mysqli_query($conn, $sqlVendorC);
        $rowVendorC = mysqli_fetch_assoc($resultVendorC);
        $countVendorC = $rowVendorC['count'];

        $sqlVendorC_active = "SELECT COUNT(id) as count FROM vendor WHERE status=1";
        $resultVendorC_active = mysqli_query($conn, $sqlVendorC_active);
        $rowVendorC_active = mysqli_fetch_assoc($resultVendorC_active);
        $countVendorC_active = $rowVendorC_active['count'];


        $sqlVendorC_inactive = "SELECT COUNT(id) as count FROM vendor WHERE status=0";
        $resultVendorC_inactive = mysqli_query($conn, $sqlVendorC_inactive);
        $rowVendorC_inactive = mysqli_fetch_assoc($resultVendorC_inactive);
        $countVendorC_inactive = $rowVendorC_inactive['count'];

        $sqlVendorC_high = "SELECT COUNT(id) as count FROM vendor WHERE threat_score>=70";
        $resultVendorC_high = mysqli_query($conn, $sqlVendorC_high);
        $rowVendorC_high = mysqli_fetch_assoc($resultVendorC_high);
        $countVendorC_high = $rowVendorC_high['count'];


        $api_key = $_COOKIE['api_key'];




        $header_name = 'Dashboard';

        include('../includes/header.php');


        /*************** statistics ************/


        date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d');








        ?>
        <div class="content-body">


            <div class="page-titles" style="margin-left: 21px;">
                <ol class="breadcrumb" style="display: flex;justify-content: space-between;">
                    <li class="breadcrumb-item"><a href="javascript:void(0)"></a></li>
                    <li class="" style="margin-right: 32px;"><a href="javascript:void(0)" style="margin-top: 11px;display: flex;">


                        </a></li>


                </ol>


            </div>


            <div class="container-fluid" style="padding-top: 0;">

                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">


                            <div class="col-xl-3 col-lg-6 col-sm-6">
                                <div class="widget-stat card bg-info">
                                    <div class="card-body  p-4">
                                        <div class="media">
                                            <div class="row">
                                                <div class="media-body text-white col-10">
                                                    <p class="mb-1">Total Vendor</p>
                                                    <h3 class="text-white"><?php echo $countVendorC; ?></h3>
                                                </div>
                                                <div class="col-2">
                                                    <i class="flaticon-381-id-card-2" style="font-size: 30px;color: white;"></i>

                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6">
                                <div class="widget-stat card bg-primary">
                                    <div class="card-body p-4">
                                        <div class="media">
                                            <div class="row">
                                                <div class="media-body text-white col-10">
                                                    <p class="mb-1">Active Vendor</p>
                                                    <h3 class="text-white"><?php echo $countVendorC_active; ?></h3>

                                                </div>
                                                <div class="col-2">
                                                    <i class="flaticon-381-user-9" style="font-size: 30px;color: white;"></i>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6">
                                <div class="widget-stat card bg-primary">
                                    <div class="card-body p-4">
                                        <div class="media">
                                            <div class="row">
                                                <div class="media-body text-white col-10">
                                                    <p class="mb-1">Inactive Vendor</p>
                                                    <h3 class="text-white"><?php echo $countVendorC_inactive; ?></h3>

                                                </div>
                                                <div class="col-2">
                                                    <i class="flaticon-381-user-9" style="font-size: 30px;color: white;"></i>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-6 col-sm-6">
                                <div class="widget-stat card bg-danger">
                                    <div class="card-body p-4">
                                        <div class="media">
                                            <div class="row">
                                                <div class="media-body text-white col-10">

                                                    <p class="mb-1">High Threat Count</p>
                                                    <h3 class="text-white"><?php echo $countVendorC_high; ?>
                                                    </h3>
                                                </div>
                                                <div class="col-2">
                                                    <i class="flaticon-381-error" style="font-size: 30px;color: white;"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Vendor List</h4>
                                        <div style="display: flex;">
                                            <a href="export_excel.php"><button type="button" class="btn btn-block btn-primary">Export Excel</button></a>
                                            <a href="export_pdf.php"><button type="button" class="btn btn-block btn-primary">Export PDF</button></a>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <?php

                                        $sql = "SELECT * FROM vendor ORDER BY id DESC  LIMIT 0,5";


                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {

                                        ?>
                                            <table class="table table-responsive-md" style="text-align: center;">
                                                <thead>
                                                    <tr>
                                                        <th class="width80"><strong>#</strong></th>
                                                        <th><strong>Vendor name</strong></th>
                                                        <th><strong>Email</strong></th>
                                                        <th><strong>Mobile no</strong></th>
                                                        <th><strong>Working hrs</strong></th>
                                                        <th><strong>Threat Score</strong></th>
                                                        <th><strong>Status</strong></th>

                                                    </tr>
                                                </thead>

                                                <?php

                                                $sNo = 0;
                                                while ($row = mysqli_fetch_assoc($result)) {

                                                    $sNo++;
                                                    $score = $row['threat_score'];
                                                    $active_status = $row['status'];

                                                    if ($score >= 70) {
                                                        $badge = '<span class="badge bg-danger">High Threat ' . $score . '% </span>';
                                                    } elseif ($score >= 40) {
                                                        $badge =  '<span class="badge bg-warning text-dark">Medium Threat ' . $score . '% </span>';
                                                    } else {
                                                        $badge =  '<span class="badge bg-success">Low Threat ' . $score . '% </span>';
                                                    }
                                                    if ($active_status == 1) {
                                                        $active_status = 'Active';
                                                    } else {
                                                        $active_status = 'Inactive';
                                                    }




                                                ?>
                                                    <tbody>
                                                        <tr>
                                                            <td><strong><?php echo $sNo; ?></strong></td>
                                                            <td><?php echo $row['vendor_name']; ?></td>
                                                            <td><?php echo $row['vendor_email']; ?></td>
                                                            <td><?php echo $row['vendor_mobile']; ?></td>
                                                            <td><?php echo $row['working_hrs']; ?></td>
                                                            <td><?php echo $badge; ?></td>
                                                            <td><?php echo $active_status; ?></td>

                                                        </tr>
                                                <?php
                                                }
                                            }
                                                ?>


                                                    </tbody>
                                            </table>

                                    </div>
                                    <a href="../vendor-profile/" style="text-align: center;">View More</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <?php include('../includes/footer.php') ?>


    </div>


    <script src="../vendor/global/global.min.js"></script>
    <script src="../vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="../vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/dlabnav-init.js"></script>
    <script src="../vendor/owl-carousel/owl.carousel.js"></script>

    <script src="../vendor/peity/jquery.peity.min.js"></script>

    <!--<script src="../vendor/apexchart/apexchart.js"></script>-->

    <!--<script src="../js/dashboard/dashboard-1.js"></script>-->
    <script src="../js/highCharts.js"></script>
    <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxCPf2gzWwkVQhMzFWGUeJIZ_a4ClTqn8"></script>-->


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>



    <script>




    </script>
</body>

</html>