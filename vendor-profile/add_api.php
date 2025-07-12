 <?php

    include("../includes/connection.php");


    if (isset($_POST['vendor_name']) && isset($_POST['mob_no']) && isset($_POST['email']) && isset($_POST['working_hrs']) && isset($_POST['active_status'])) {

        $vendor_name = clean($_POST['vendor_name']);
        $mob_no = clean($_POST['mob_no']);
        $email = clean($_POST['email']);
        $working_hrs = clean($_POST['working_hrs']);
        $active_status = clean($_POST['active_status']);

        $active_mon = clean($_POST['active_mon']);



        $api_key = $_COOKIE['api_key'];


        // $staff_id = $_COOKIE['user_id'];
        // $cookie_emp_id = $_COOKIE['emp_id'];



        $sqlValidateCookie = "SELECT * FROM `staff` WHERE api_key='$api_key'";
        $resValidateCookie = mysqli_query($conn, $sqlValidateCookie);
        if (mysqli_num_rows($resValidateCookie) > 0) {

            $sqlValidateM = "SELECT * FROM `vendor` WHERE `vendor_mobile`='$mob_no'";
            $resValidateM = mysqli_query($conn, $sqlValidateM);
            if (mysqli_num_rows($resValidateM) == 0) {

                $sqlValidateM11 = "SELECT * FROM `vendor` WHERE `vendor_email`='$email'";
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


                    $sqlInsert = "INSERT INTO `vendor`(`vendor_id`,`vendor_name`,`vendor_email`,`vendor_mobile`,`working_hrs`,`threat_score`,`status`) 
                                    VALUES ('','$vendor_name','$email','$mob_no','$working_hrs','$threatScore','$active_status')";
                    mysqli_query($conn, $sqlInsert);

                    $ID = mysqli_insert_id($conn);

                    if (strlen($ID) == 1) {
                        $ID = '00' . $ID;
                    } elseif (strlen($ID) == 2) {
                        $ID = '0' . $ID;
                    }

                    $vendor_id = "V" . ($ID);

                    $sqlUpdate = "UPDATE vendor SET vendor_id ='$vendor_id' WHERE id ='$ID'";
                    mysqli_query($conn, $sqlUpdate);



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
                    $json_array['msg'] = "Added successfully !!!";
                    $json_response = json_encode($json_array);
                    echo $json_response;
                } else {
                    //Parameters missing

                    $json_array['status'] = "failure";
                    $json_array['msg'] = "Email Already Exist!!!";
                    $json_response = json_encode($json_array);
                    echo $json_response;
                }
            } else {
                //Parameters missing

                $json_array['status'] = "failure";
                $json_array['msg'] = "Mobile No Already exist !!!";
                $json_response = json_encode($json_array);
                echo $json_response;
            }
        } else {

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



    function clean($data)
    {
        $data = str_replace("'", "", $data);
        $data = str_replace('"', "", $data);
        return filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    }


    function isRandomInRange($mRandom)
    {
        if (($mRandom >= 58 && $mRandom <= 64) ||
            (($mRandom >= 91 && $mRandom <= 96))
        ) {
            return 0;
        } else {
            return $mRandom;
        }
    }

    function findRandom()
    {
        $mRandom = rand(48, 122);
        return $mRandom;
    }

    ?>
