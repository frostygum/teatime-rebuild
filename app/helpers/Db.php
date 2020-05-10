<?php

require_once CONFIG_PATH . 'dbConfig.php';
class DB extends DBConfig
{
    protected $connection;
    protected $error = null;

    private function open_connection()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        
        if ($this->connection->connect_errno) {
            $this->error = 'Could not connect to ' . $this->host . ' server';
        }
    }

    public function close_connection()
    {
        $this->connection->close();
    }

    public function escapeString($str)
    {
        $this->open_connection();
        return $this->connection->escape_string($str);
    }

    public function executeMultiQuery($query)
    {
        $this->open_connection();
        $result = [];

        if (!$this->connection->multi_query($query)) {
            $this->error =  "Multi query failed: (" . $this->connection->errno . ") " . $this->connection->error;
            return false;
        }
        
        do {
            if ($res = $this->connection->store_result()) {
                $result[] = $res->fetch_all(MYSQLI_ASSOC);
                $res->free();
            }
        } while ($this->connection->more_results() && $this->connection->next_result());

        $this->close_connection();
        return $result;
    }

    public function executeSelectQuery($query)
    {
        $this->open_connection();
        $query_result = $this->connection->query($query);
        $result = [];
        if($query_result != false) {
            if ($query_result->num_rows > 0) {
                while ($row = $query_result->fetch_assoc()) {
                    $result[] = $row;
                }
            }
        }
        else {
            $this->error =  $this->connection->error;
            return false;
        }
        $this->close_connection();
        return $result;
    }

    public function executeNonSelectQuery($query)
    {
        $this->open_connection();
        $query_result = $this->connection->query($query);
        if (!$query_result) {
            $this-> error = $this->connection->error;
            return false;
        }
        $this->close_connection();
        return $query_result;
    }

    public function get_error() {
        return $this->error;
    }
}
