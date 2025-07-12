<?php
include("../includes/connection.php");
error_reporting(0);
date_default_timezone_set("Asia/kolkata");

$page = $_GET['page_no'];

if ($_COOKIE['api_key'] == '') {
    header("Location: ../login?logout=1");
}

if ($page == '')
    $page = 1;

$pageSql = $page - 1;
$start = $pageSql * 10;



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Vendor Profile</title>

    <link rel="icon" type="image/png" sizes="16x16" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRnMsya0otsTJNljvhBeSxgDTZojQfRS1D3TA&s">
    <link href="../vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/chartist/css/chartist.min.css">

    <link href="../vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="../vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<style>
    .error {
        color: red;
    }

    .page-titles {
        display: flex;
        justify-content: space-between;
    }

    .responsive {
        display: flex;
        justify-content: space-between;
        flex-direction: column;
    }

    .responsive_search_box {
        display: flex;
        justify-content: flex-end;
    }


    @media only screen and (max-width: 650px) {
        .responsive {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;

        }

    }

    @media only screen and (max-width: 399px) {
        .responsive_search_box {
            display: flex;
            justify-content: center;
            flex-direction: column;
        }
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
        $header_name = 'Vendor Profile';

        include('../includes/header.php');
        ?>


        <div class="content-body">

            <div class="page-titles" style="margin-left: 21px;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Vendor Profile</a></li>


                </ol>
                <div>



                </div>

            </div>


            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header responsive">
                        <h4 class="card-title" style="margin-bottom: 14px;">List of Vendor Profile</h4>
                        <div class="responsive_search_box">
                            <!-- <form class="form-inline">
                     
                          
                            <div class="form-group mx-sm-3 mb-2">

                                <input type="text" class="form-control" placeholder="Search By Name" name="search" id="search" style="border-radius:20px;color:black;border:1px solid black;" >

                            </div>
                            <button type="submit" class="btn btn-primary mb-2" style="margin-left: 14px;">Search</button>
                        </form> -->
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#form_modal" style="margin-left: 20px;" onclick="addTitle()">ADD</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <?php

                            $sql = "SELECT * FROM vendor ORDER BY id DESC  LIMIT $start,10";


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



                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <?php

                                    $sNo = $start;
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




                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-success light sharp"
                                                            data-toggle="dropdown">
                                                            <svg width="20px" height="20px" viewbox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                                    <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                    <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                    <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                                </g>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-menu">

                                                            <a class="dropdown-item" data-toggle="modal"
                                                                data-target="#form_modal" style="cursor: pointer"
                                                                onclick="editTitle('<?php echo $row['vendor_id']; ?>')">Edit</a>
                                                            <!--                                  -->
                                                            <a class="dropdown-item" style="cursor: pointer"
                                                                onclick="delete_model('<?php echo $row['vendor_id'];; ?>')">Delete</a>


                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                    }

                                        ?>

                                        </tbody>
                                </table>
                                <div class="col-12 pl-3" style="display: flex;justify-content: center;">
                                    <nav>
                                        <ul class="pagination pagination-gutter pagination-primary pagination-sm no-bg">

                                            <?php

                                            $prevPage = abs($page - 1);
                                            if ($prevPage > 0) {
                                            ?>
                                                <li class="page-item page-indicator"><a class="page-link"
                                                        href="?page_no=<?php echo 1 ?>"><i
                                                            class="la la-angle-double-left" style="padding-top: 9px;"></i></a></li>
                                            <?php
                                            }
                                            if ($prevPage == 0) {
                                            ?>
                                                <li class="page-item page-indicator"><a class="page-link"
                                                        href="javascript:void(0);"><i
                                                            class="la la-angle-left" style="padding-top: 9px;"></i></a></li>
                                            <?php
                                            } else {
                                            ?>
                                                <li class="page-item page-indicator"><a class="page-link"
                                                        href="?page_no=<?php echo $prevPage ?>"><i
                                                            class="la la-angle-left" style="padding-top: 9px;"></i></a></li>
                                                <?php
                                            }

                                            if ($search == "") {
                                                $sql = "SELECT COUNT(id) as count FROM vendor";
                                            }


                                            $result = mysqli_query($conn, $sql);


                                            if (mysqli_num_rows($result)) {


                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['count'];
                                                $show = 10;


                                                $get = $count / $show;


                                                $pageFooter = floor($get);

                                                if ($get > $pageFooter) {
                                                    $pageFooter++;
                                                }

                                                for ($i = 1; $i <= $pageFooter; $i++) {

                                                    if ($i == $page) {
                                                        $active = "active";
                                                    } else {
                                                        $active = "";
                                                    }

                                                    if ($i <= ($pageSql + 10) && $i > $pageSql || $pageFooter <= 10) {

                                                        //             
                                                ?>

                                                        <li class="page-item <?php echo $active ?>"><a class="page-link"
                                                                href="?page_no=<?php echo $i ?>"><?php echo $i ?></a>
                                                        </li>
                                                    <?php
                                                    }
                                                }

                                                $nextPage = $page + 1;


                                                if ($nextPage > $pageFooter) {
                                                    ?>
                                                    <li class="page-item page-indicator"><a class="page-link"
                                                            href="javascript:void(0);"><i
                                                                class="la la-angle-right" style="padding-top: 9px;"></i></a></li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li class="page-item page-indicator"><a class="page-link"
                                                            href="?page_no=<?php echo $nextPage ?>"><i
                                                                class="la la-angle-right" style="padding-top: 9px;"></i></a></li>
                                                <?php
                                                }
                                                if ($nextPage < $pageFooter) {
                                                ?>
                                                    <li class="page-item page-indicator"><a class="page-link"
                                                            href="?page_no=<?php echo $pageFooter ?>"><i
                                                                class="la la-angle-double-right" style="padding-top: 9px;"></i></a></li>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </nav>
                                </div>
                            <?php
                            } else {

                            ?>
                                <h1 style="text-align:center">No Record Found <span style='font-size:40px;'>&#128533;</span>
                                </h1>
                            <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>

            </div>





            <div class="modal fade" id="form_modal" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">


                            <h5 class="modal-title" id="title"></h5>

                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">




                            <div class="basic-form" style="color: black;">
                                <form id="forms" autocomplete="off">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <!-- <input type="hidden" class="form-control" id="driver_id" name="driver_id" style="border-color: #181f5a;color: black"> -->
                                            <input type="hidden" class="form-control" id="api" name="api">
                                            <input type="hidden" class="form-control" id="vendor_id" name="vendor_id">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Vendor Name *</label>
                                            <input type="text" class="form-control" placeholder="Eg : ABC company" id="vendor_name" name="vendor_name" style="border-color: #181f5a;color: black;">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Vendor Email </label>
                                            <input type="email" class="form-control" placeholder="Eg : abc@gmail.com" id="email" name="email" style="border-color: #181f5a;color: black">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Vendor Mobile </label>
                                            <input type="number" class="form-control" placeholder="Mobile No" id="mob_no" name="mob_no" style="border-color: #181f5a;color: black">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Working hrs (per day) *</label>
                                            <input type="text" class="form-control" placeholder="Eg : 1" id="working_hrs" name="working_hrs" style="border-color: #181f5a;color: black;">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Active Month</label>

                                            <select id="active_mon" name="active_mon[]" class="form-control default-select" multiple="multiple" style="border: 1px solid black;color: black;">

                                                <?php
                                                for ($m = 1; $m <= 12; $m++) {
                                                    $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                                                ?>
                                                    <option value="<?php echo $m ?>"><?php echo $month ?></option>

                                                <?php
                                                }

                                                ?>


                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Status</label>
                                            <select class="form-control" id="active_status" name="active_status" style="border-color: #181f5a;color: black">
                                                <option value='1'>Active</option>
                                                <option value='0'> Inactive</option>


                                            </select>
                                        </div>





                                    </div>


                                </form>
                            </div>





                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light" data-dismiss="modal" style="background-color: red; color: white;">Close</button>
                            <button type="button" class="btn btn-primary" id="add_btn">ADD</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>



        <?php include('../includes/footer.php') ?>



    </div>

    <script>

    </script>
    <script src="../vendor/global/global.min.js"></script>
    <script src="../vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="../vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/dlabnav-init.js"></script>
    <script src="../vendor/owl-carousel/owl.carousel.js"></script>

    <script src="../vendor/peity/jquery.peity.min.js"></script>

    <!--<script src="../vendor/apexchart/apexchart.js"></script>-->

    <script src="../js/dashboard/dashboard-1.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../vendor/jquery-validation/jquery.validate.min.js"></script>

    <script src="../js/plugins-init/jquery.validate-init.js"></script>


    <script src="../vendor/moment/moment.min.js"></script>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.3/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>


    <!--change title in modal-->
    <script>
        // $(function() {
        //     $('#datetimepicker1').datetimepicker({
        //         format: 'hh:mm A',
        //     });
        //
        // });
        function addTitle() {
            $("#title").html("Add Vendor Profile");
            $('#forms')[0].reset();
            $('#api').val("add_api.php")

        }

        function editTitle(data) {

            $("#title").html("Edit Vendor Profile- " + data);
            $('#forms')[0].reset();
            $('#api').val("edit_api.php")

            $.ajax({

                type: "POST",
                url: "view_api.php",
                data: 'vendor_id=' + data,
                dataType: "json",
                success: function(res) {
                    if (res.status == 'success') {

                        $("#vendor_id").val(res.vendor_id);
                        $("#vendor_name").val(res.vendor_name);
                        $("#mob_no").val(res.mob_no);
                        $("#email").val(res.email);
                        $("#working_hrs").val(res.working_hrs);

                        $("#active_status").val(res.active_status);

                        $("#active_mon").val(res.active_mon);

                        $('#active_status').trigger('change');

                        $('#active_mon').trigger('change');




                        var edit_model_title = "Edit Vendor Profile - " + data;
                        $('#title').html(edit_model_title);
                        $('#add_btn').html("Save");


                        $('#form_modal').modal('show');


                    } else if (res.status == 'wrong') {
                        swal("Invalid", res.msg, "warning")
                            .then((value) => {
                                window.window.location.reload();
                            });

                    } else if (res.status == 'failure') {
                        swal("Failure", res.msg, "error")
                            .then((value) => {
                                window.window.location.reload();

                            });

                    }
                },
                error: function() {
                    swal("Check your network connection");

                    window.window.location.reload();

                }

            });

        }



        //to validate form
        $("#forms").validate({
            ignore: '.ignore',
            // Specify validation rules
            rules: {

                vendor_name: {
                    required: true
                },

                email: {
                    required: true,
                    email: true
                },
                mob_no: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },

                working_hrs: {
                    required: true,
                    digits: true,
                    range: [1, 24]
                },



            },
            // Specify validation error messages
            messages: {
                email: {
                    required: "Please enter an email",
                    email: "Please enter a valid email address"
                },
                mob_no: {
                    required: "Please enter a mobile number",
                    digits: "Please enter only digits",
                    minlength: "Mobile number must be 10 digits",
                    maxlength: "Mobile number must be 10 digits"
                },
                working_hrs: {
                    required: "Please enter working hours",
                    digits: "Only numeric values allowed",
                    range: "Working hours must be between 1 and 24"
                }
            }
            // Make sure the form is submitted to the destination defined
        });
        //add data
        $('#add_btn').click(function() {




            $("#forms").valid();
            if ($("#forms").valid() == true) {

                var api = $('#api').val();
                var active_mon = $('#active_mon').val();

                var form = $("#forms");

                var formData = new FormData(form[0]);
                formData.append('active_mon', active_mon);

                this.disabled = true;
                this.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
                $.ajax({
                    type: "POST",
                    url: api,
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function(res) {
                        if (res.status == 'success') {
                            Swal.fire({
                                    title: "Success",
                                    text: res.msg,
                                    icon: "success",
                                    button: "OK",
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    closeOnClickOutside: false,
                                })
                                .then((value) => {
                                    window.window.location.reload();
                                });
                        } else if (res.status == 'failure') {

                            Swal.fire({
                                    title: "Failure",
                                    text: res.msg,
                                    icon: "warning",
                                    button: "OK",
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    closeOnClickOutside: false,
                                })
                                .then((value) => {

                                    document.getElementById("add_btn").disabled = false;
                                    document.getElementById("add_btn").innerHTML = 'Add';
                                });

                        }
                    },
                    error: function() {

                        Swal.fire('Check Your Network!');
                        document.getElementById("add_btn").disabled = false;
                        document.getElementById("add_btn").innerHTML = 'Add';
                    }

                });

            } else {
                document.getElementById("add_btn").disabled = false;
                document.getElementById("add_btn").innerHTML = 'Add';

            }


        });



        //delete model

        function delete_model(data) {

            Swal.fire({
                    title: "Delete",
                    text: "Are you sure want to delete the record?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    closeOnClickOutside: false,
                    showCancelButton: true,

                })
                .then((value) => {
                    if (value.isConfirmed) {

                        $.ajax({

                            type: "POST",
                            url: "delete_api.php",
                            data: 'vendor_id=' + data,
                            dataType: "json",
                            success: function(res) {
                                if (res.status == 'success') {
                                    Swal.fire({
                                            title: "Success",
                                            text: res.msg,
                                            icon: "success",
                                            button: "OK",
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                            closeOnClickOutside: false,
                                        })
                                        .then((value) => {
                                            window.window.location.reload();

                                        });
                                } else if (res.status == 'failure') {
                                    Swal.fire({
                                            title: "Failure",
                                            text: res.msg,
                                            icon: "warning",
                                            button: "OK",
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                            closeOnClickOutside: false,
                                        })
                                        .then((value) => {
                                            window.window.location.reload();
                                        });

                                }
                            },
                            error: function() {
                                swal("Check your network connection");

                            }

                        });

                    }
                });

        }
    </script>


</body>

</html>