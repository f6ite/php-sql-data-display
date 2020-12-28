<?php

    require_once("../config.php");

    class Database 
    {

        private $_handle = null;

        /*
         * Connect to the Database. Returning the Connection.
         */
        public function connect() {
            $this->_handle = null;
            
            try {
                $this->_handle = new PDO(
                    'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_AUTH
                );

                $this->_handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $pdoExc) {
                echo 'Connection Failed: ' . $pdoExc->getMessage();
            }

            return $this->_handle;
        }

    }