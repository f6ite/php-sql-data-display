<?php

    /*
     * Defines a Model for an Entry in the Database.
     */

    class School {

        public $school_id;
        public $school_area;
        public $school_name;
        public $school_street;
        public $school_town;
        public $school_postcode;
        public $school_type;
        public $school_gender;

        private $db_conn;
        private $db_data_table;

        public function __construct($connection) {
            $this->db_conn = $connection;
            $this->db_data_table = 'mytable';
        }

        public function get() {
            $_query = 'SELECT * FROM ' . $this->db_data_table;

            $result = $this->db_conn->prepare($_query);
            $result->execute();

            return $result;
        }

        public function getSingle($id) {
            $_query = 'SELECT * FROM ' . $this->db_data_table . ' WHERE PrimKey = :id';

            $result = $this->db_conn->prepare($_query);
            $result->bindParam(":id", $id);

            $result->execute();
            
            return $result;
        }

        public function update() {

            $_query = 'UPDATE ' . $this->db_data_table . ' SET LANAME = :area_name, SCHOOL_NAME = :school_name, STREET = :street, TOWN = :town, POSTCODE = :postcode, SCHOOLTYPE = :school_type, GENDER = :gender WHERE PrimKey = :id';
                
            $result = $this->db_conn->prepare($_query);

            // @TODO: Prevent Against SQL Injection.

            $result->bindParam(":area_name", $this->school_area);
            $result->bindParam(":school_name", $this->school_name);
            $result->bindParam(":street", $this->school_street);
            $result->bindParam(":town", $this->school_town);
            $result->bindParam(":postcode", $this->school_postcode);
            $result->bindParam(":school_type", $this->school_type);
            $result->bindParam(":gender", $this->school_gender);
            $result->bindParam(":id", $this->school_id);
       
	    $complete = $result->execute();

            if ($complete) {
                return true;
            } else {
		echo "An Error Occured";
		return false;
	    }

	     echo "This should <strong>not</strong> be visible.";
	}

    }
