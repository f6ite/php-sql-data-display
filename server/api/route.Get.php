<?php

    /*
     * Reads Data from the Database. Presenting it as JSON.
     */

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: Application/JSON');

    require_once('../database/class.Database.php');
    require_once('./data/model.School.php');

    // New instance of the Database
    $_db_inst = new Database();

    // Connect to the Database.
    $db_conn = $_db_inst->connect();
    
    // Instance a new school data model.
    $schools = new School($db_conn);

    $data = array();
    
    $result = null;

    if (isset($_GET['id'])) {
        // Get a Single Record.
        $result = $schools->getSingle($_GET['id']);
    } else {
        // Get all the data from the database.
        $result = $schools->get();
    }
    // Store the length of the data array.
    $result_count = $result->rowCount();

    if ($result_count > 0) {
    
        // This will be used to encode the JSON.
        $arr = array();
        $arr['data'] = array();

        // Fetch all the data in our result variable.
        while ($x = $result->fetch(PDO::FETCH_ASSOC)) {
            // extract into an array.
            extract($x);

            // the variables on the right are the column names in the database.
            // whilst the labels on the left are the names of our json properties.
            $json_data = array(
                'id' => $PrimKey,
                'area_name' => $LANAME,
                'school_name' => $SCHOOL_NAME,
                'street' => $STREET,
                'town' => $TOWN,
                'postcode' => $POSTCODE,
                'school_type' => $SCHOOLTYPE,
                'gender' => $GENDER
            );

            // append the above array with our array declared outside the loop.
            array_push($arr['data'], $json_data);
        }

        // encode to json and echo to the page.
        echo json_encode($arr);
    } else {
        // we have no data :(
        echo json_encode(
            array('message' => 'No Data.')
        );
    }