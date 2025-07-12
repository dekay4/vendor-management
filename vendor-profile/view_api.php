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


            $json_array['status'] = 'success';
            $json_array['vendor_id'] = $row['vendor_id'];
            $json_array['vendor_name'] = $row['vendor_name'];
            $json_array['mob_no'] = $row['vendor_mobile'];
            $json_array['email'] = $row['vendor_email'];
            $json_array['working_hrs'] = $row['working_hrs'];
            // $json_array['threat_score'] = $row['threat_score'];
            $json_array['active_status'] = $row['status'];

            $arr = array();


            $sql = "SELECT * FROM vendor_active_month WHERE vendor_id='$vendor_id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {

                    $arr[] = $row['month'];
                }
            }

            $json_array['active_mon'] =  $arr;

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
