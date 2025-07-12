<?php
if (isset($_POST['vendor_id'])) {
    include("../includes/connection.php");

    $vendor_id = clean($_POST['vendor_id']);

    $vendor_name = clean($_POST['vendor_name']);
    $mob_no = clean($_POST['mob_no']);
    $email = clean($_POST['email']);
    $working_hrs = clean($_POST['working_hrs']);
    $active_status = clean($_POST['active_status']);

    $active_mon = clean($_POST['active_mon']);


    //
    $api_key = $_COOKIE['api_key'];
    //
    //    $staff_id = $_COOKIE['user_id'];
    //

    // $cookie_emp_id = $_COOKIE['emp_id'];


    //
    //

    $sqlValidateCookie = "SELECT * FROM `staff` WHERE api_key='$api_key'";
    $resValidateCookie = mysqli_query($conn, $sqlValidateCookie);
    if (mysqli_num_rows($resValidateCookie) > 0) {



        $sqlValidate = "SELECT * FROM `vendor` WHERE vendor_id!='$vendor_id' AND vendor_mobile='$mob_no'";
        $resValidate = mysqli_query($conn, $sqlValidate);
        if (mysqli_num_rows($resValidate) == 0) {

            $sqlValidateM11 = "SELECT * FROM `vendor` WHERE `vendor_email`='$email' AND `vendor_id`!='$vendor_id'";
            $resValidateM11 = mysqli_query($conn, $sqlValidateM11);
            if (mysqli_num_rows($resValidateM11) == 0) {

                $active_mon_array = explode(",", $active_mon);

                $length = count($active_mon_array);

                $totalWorkingHours = $working_hrs * 7;
                $activeMonthsCount = $length;
                $workingHourPenalty = (84 - $totalWorkingHours) * 1;
                $monthPenalty = (12 - $activeMonthsCount) * 2;

                $threatScore = $workingHourPenalty + $monthPenalty;
                $threatScore = min(max(round($threatScore), 0), 100);


                $sqlUpdate = "UPDATE `vendor` SET `vendor_name`='$vendor_name',`vendor_email`='$email',`vendor_mobile`='$mob_no',`working_hrs`='$working_hrs',`status`='$active_status',`threat_score`='$threatScore' WHERE `vendor_id`='$vendor_id'";
                mysqli_query($conn, $sqlUpdate);


                $sqlDelete = "DELETE FROM `vendor_active_month` WHERE vendor_id='$vendor_id'";
                mysqli_query($conn, $sqlDelete);

                for ($i = 0; $i < $length; $i++) {

                    $active_mon_n = $active_mon_array[$i];

                    if ($active_mon_n != '') {

                        $sqlInsertId = "INSERT INTO `vendor_active_month`(`vendor_id`,`month`) 
                                            VALUES ('$vendor_id','$active_mon_n')";

                        mysqli_query($conn, $sqlInsertId);
                    }
                }



                //inserted successfully

                $json_array['status'] = "success";
                $json_array['msg'] = "Updated successfully !!!";
                $json_response = json_encode($json_array);
                echo $json_response;
            } else {
                //staff id already exist

                $json_array['status'] = "failure";
                $json_array['msg'] = "Email Already Exists !!!";
                $json_response = json_encode($json_array);
                echo $json_response;
            }
        } else {
            $json_array['status'] = "failure";
            $json_array['msg'] = "Mobile no Is Already Exists !!!";
            $json_response = json_encode($json_array);
            echo $json_response;
        }
    } else {
        //    setcookie("access_status", 0, time() + (3600 *120), "/"); // To set Login for 1 hr
        $json_array['status'] = "failure";
        $json_array['msg'] = "Please try after sometime !!!";
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


function clean($data)
{
    $data = str_replace("'", "", $data);
    $data = str_replace('"', "", $data);
    return filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
}
