<?php

    include_once('../database/class.Database.php');
    include_once('data/model.School.php');

    $_db_inst = new Database();

    $db_conn = $_db_inst->connect();
    $schools = new School($db_conn);

    if (isset($_POST['update_ID']) 
     && isset($_POST['update_SchoolName'])
     && isset($_POST['update_PostCode'])
     && isset($_POST['update_Town'])
     && isset($_POST['update_Street'])
     && isset($_POST['update_Type'])
     && isset($_POST['update_Gender'])
     && isset($_POST['update_County'])) {

         $schools->school_id = $_POST['update_ID'];
         $schools->school_name = $_POST['update_SchoolName'];
         $schools->school_postcode = $_POST['update_PostCode'];
         $schools->school_town = $_POST['update_Town'];
         $schools->school_street = $_POST['update_Street'];
         $schools->school_type = $_POST['update_Type'];
         $schools->school_gender = $_POST['update_Gender'];
         $schools->school_area = $_POST['update_County'];
         
         if ($schools->update()) {
             header('Location: http://51.140.166.221/?updated');
	 } else {
             echo "An Error Occured";
         }

    } else {
        echo 'No Data Sent';
    }
