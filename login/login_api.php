<?php
include("../includes/connection.php");

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = clean($_POST['email']);

    $password = clean($_POST['password']);

    $remember = 0;




    $sqlValidate = "SELECT * FROM `staff` WHERE email='$email' AND pwd='$password'";
    $resValidate = mysqli_query($conn, $sqlValidate);
    if (mysqli_num_rows($resValidate) > 0) {

        $sqlValidateS = "SELECT * FROM `staff` WHERE email='$email' AND pwd='$password'";
        $resValidateS = mysqli_query($conn, $sqlValidateS);
        if (mysqli_num_rows($resValidateS) > 0) {

            if ($remember == 1) {
                $cookie_set = 120;
            } else {
                $cookie_set = 1;
            }
            $cookie_set = 120;

            $row = mysqli_fetch_array($resValidate);




            setcookie("api_key", $row['api_key'], time() + (3600 * $cookie_set), "/"); // To set Login for 1 hr
            setcookie("user_name", $row['user_name'], time() + (3600 * $cookie_set), "/"); // To set Login for 1 hr


            //  echo "{\"result\":\"success\"}";
            $json_array['result'] = "success";
            //            $json_array['msg'] = "success";
            $json_response = json_encode($json_array);
            echo $json_response;
        } else {
            $json_array['result'] = "failure";
            $json_array['msg'] = "Access Status Denied !!";
            $json_response = json_encode($json_array);
            echo $json_response;
            //echo "{\"result\":\"wrong\"}";
        }
    } else {
        $json_array['result'] = "failure";
        $json_array['msg'] = "Email Or Password Was Wrong !!";
        $json_response = json_encode($json_array);
        echo $json_response;
        //echo "{\"result\":\"wrong\"}";
    }
} else {

    echo "{\"result\":\"failure\"}";
}
function clean($data)
{
    return filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
}
