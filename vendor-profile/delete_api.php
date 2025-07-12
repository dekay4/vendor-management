<?php
if (isset($_POST['vendor_id'])) {
    include("../includes/connection.php");


    $api_key = $_COOKIE['api_key'];
    $vendor_id = $_POST['vendor_id'];
    $sqlValidateCookie = "SELECT * FROM `staff` WHERE api_key='$api_key'";
    $resValidateCookie = mysqli_query($conn, $sqlValidateCookie);
    if (mysqli_num_rows($resValidateCookie) > 0) {


        $sqlValidateCookie1 = "SELECT * FROM `vendor` WHERE vendor_id='$vendor_id' ";
        $resValidateCookie1 = mysqli_query($conn, $sqlValidateCookie1);
        if (mysqli_num_rows($resValidateCookie1) > 0) {
            $row = mysqli_fetch_array($resValidateCookie1);


            $sqlUpdate = "DELETE FROM `vendor` WHERE vendor_id='$vendor_id'";
            mysqli_query($conn, $sqlUpdate);

            $sqlDelete = "DELETE FROM `vendor_active_month` WHERE vendor_id='$vendor_id'";
            mysqli_query($conn, $sqlDelete);


            $json_array['status'] = "success";
            $json_array['msg'] = "Deleted successfully !!!";
            $json_response = json_encode($json_array);
            echo $json_response;
        } else {
            //staff id already exist

            $json_array['status'] = "failure";
            $json_array['msg'] = "Please try after sometime";
            $json_response = json_encode($json_array);
            echo $json_response;
        }
    } else {
        //staff id already exist
        //    setcookie("access_status", 0, time() + (3600 *120), "/"); // To set Login for 1 hr
        $json_array['status'] = "failure";
        $json_array['msg'] = "Invalid Login !!!";
        $json_response = json_encode($json_array);
        echo $json_response;
    }
} else {
    //Parameters missing

    $json_array['status'] = "failure";
    $json_array['msg'] = "Please try after sometime !!!";
    $json_response = json_encode($json_array);
    echo $json_response;
}
