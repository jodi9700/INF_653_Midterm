<?php
    class Database {
        // DB Params
        private $conn;
        private $host;
        private $port;
        private $db_name;
        private $username;
        private $password;

        // DB Connect
        public function connect() {
            $this->username = getenv('USERNAME');
            $this->password = getenv('PASSWORD');
            $this->db_name = getenv('DBNAME');
            $this->host = getenv('HOST');
            $this->port = getenv('PORT');

            try {
                $this->conn = new PDO('mysql:host=' . $this=>host . ';dbname= ' . $this->db_name,
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
        }
    }