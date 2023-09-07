<?php
class DBHelper {
    private $host;
    private $username;
    private $password;
    private $database;
    protected $conn;

    public function __construct($host, $username, $password, $database) {
        $this->conn = new mysqli($host, $username, $password, $database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }

    public function getConnection() {
        return $this->conn;
    }

    public function insertData($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", $data) . "'";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function updateData($table, $data, $where) {
        $setValues = [];
        foreach ($data as $key => $value) {
            $setValues[] = "$key = '$value'";
        }
        $setValuesStr = implode(", ", $setValues);
        $sql = "UPDATE $table SET $setValuesStr WHERE $where";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteData($table, $where) {
        $sql = "DELETE FROM $table WHERE $where";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function getData($table, $columns = "*", $where = "", $orderBy = "") {
        $sql = "SELECT $columns FROM $table";
        if (!empty($where)) {
            $sql .= " WHERE $where";
        }

        if (!empty($orderBy)) {
            $sql .= " ORDER BY $orderBy";
        }
    
        $result = $this->conn->query($sql);
        $data = array();
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $data[] = $row; 
            }
        }
    
        return $data;
    }
    
}

?>
