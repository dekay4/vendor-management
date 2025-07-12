<?php

$api_key = $_COOKIE['api_key'];




// Include("connection.php");
//
//$sqlAdminRestrict = "SELECT * FROM admin_login";
//
//$resultAdminRestrict = mysqli_query($conn, $sqlAdminRestrict);
//
//if (mysqli_num_rows($resultAdminRestrict)>0) {
//    $rowAdminRestrict = mysqli_fetch_assoc($resultAdminRestrict);
//
//  $expiry_date = $rowAdminRestrict['expiry_date'];
//
//    $currentDate = date('Y-m-d');
//
//    if ($currentDate > $expiry_date) {
//
//        $allowed = 1;
//        $onclickSwal = "expiryDate()";
//        $cookie_setHead =120;
//
//        setcookie("expiryDate", 'expired', time() + (3600 *$cookie_setHead), "/"); // To set Login for 1 hr
//
//
//    } else {
//        $allowed = '';
//    }
//}


?>

<div class="nav-header">
    <a href="../dashboard/" class="brand-logo">
        <img class="logo-compact" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRnMsya0otsTJNljvhBeSxgDTZojQfRS1D3TA&s" alt="">
        <img class="brand-title" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRnMsya0otsTJNljvhBeSxgDTZojQfRS1D3TA&s" alt="">
    </a>
    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>


<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        <?php echo  $header_name; ?>
                    </div>

                </div>
                <ul class="navbar-nav header-right">


                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                            <img src="../img/avatar.jpg" width="20" alt="">
                            <div class="header-info">

                                <span class="text-black"><?php echo $_COOKIE['user_name']; ?></span>
                                <p class="fs-12 mb-0">
                                    <?php
                                    date_default_timezone_set("Asia/Calcutta");

                                    if (date("H") < 12) {

                                        echo "Good Morning !";
                                    } elseif (date("H") > 11 && date("H") < 17) {

                                        echo "Good Afternoon !";
                                    } elseif (date("H") > 16) {

                                        echo "Good Evening !";
                                    }

                                    ?>
                                </p>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item ai-icon">
                                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                    width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span class="ml-2"><?php echo $_COOKIE['user_name']; ?> </span>
                            </a>

                            <a href="../login?logout=1" class="dropdown-item ai-icon">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                    width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span class="ml-2">Logout </span>
                            </a>
                            <!--                                <a href="" class="dropdown-item ai-icon"data-toggle="modal" data-target="#change_password">-->
                            <!--                                    <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"-->
                            <!--                                         width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor"-->
                            <!--                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">-->
                            <!--                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>-->
                            <!--                                        <polyline points="16 17 21 12 16 7"></polyline>-->
                            <!--                                        <line x1="21" y1="12" x2="9" y2="12"></line>-->
                            <!--                                    </svg>-->
                            <!--                                    <span class="ml-2">Change Password </span>-->
                            <!--                                </a>-->
                        </div>

                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">


            <li><a class="ai-icon" href="../dashboard/" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>



            <li><a class="ai-icon" href="../vendor-profile/" aria-expanded="false">
                    <i class="flaticon-381-user-8"></i>
                    <span class="nav-text">Vendor</span>
                </a>
            </li>


        </ul>

        <div class="copyright">
            <?php


            $text = " Admin Panel";

            ?>
            <p><strong><?php echo $text ?></strong> © <?php echo date('Y') ?> All Rights Reserved</p>
        </div>
    </div>
</div>



]

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>


<script>


</script>