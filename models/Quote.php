<?php
    class Quote {
        // DB stuff
        private $conn;
        private $table = 'quotes';

        // Quote Properties
        public $id;
        public $quote;
        public $category_id;
        public $author_id;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Authors 
        public fuction read() {
            // Create query
            $query = 'SELECT
                    a.name as category_name,
                    q.id,
                    q.quote
                FROM
                    '. $THIS->TABLE . ' q
                LEFT JOIN
                    author a ON a.author = q.author_id
                ORDER BY
                    q.created_at DESC';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Get single quote
        public function read_single() {
            // Create query
            $query = 'SELECT
                    a.name as category_name,
                    q.id,
                    q.quote,
                    q.category_id,
                    q.author_id
                FROM
                    '. $this->table . ' q
                LEFT JOIN
                    author a ON a.author = q.author_id
                WHERE
                    q.id = ?
                LIMIT 0,1';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt -> bindParam(1, $this->id);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->quote = $row['quote'];
            $this->category_id = $row['category_id'];
            $this->author_id = $row['author_id'];
        }

        // Create Quote
        public function create() {
            // Create query
            $query = 'INSERT INTO ' . $THIS->TABLE . '
                SET
                    quote = :quote,
                    author_id = :author_id,
                    category_id = :category_id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));

            // Bind data
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':author_id', $this->author_id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false
        }

        // Update Quote
        public function update() {
            // Create query
            $query = 'INSERT INTO ' . $THIS->TABLE . '
                SET
                    quote = :quote,
                    author_id = :author_id,
                    category_id = :category_id
                WHERE
                    id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Delete Quote
        public function delete() {
            // Create query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }