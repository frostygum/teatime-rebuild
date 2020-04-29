<?php

require_once CONFIG_PATH . 'dbConfig.php';

class DB extends DBConfig
{
    protected $connection;
    protected $error = null;

    private function open_connection()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->connection->connect_error) {
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

    public function executeNonSelectQuery($sql)
    {
        $this->open_connection();
        $query_result = $this->connection->query($sql);
        $this->close_connection();
        if ($query_result == false) {
            $this->error =  $this->connection->error;
            return false;
        }
        return $query_result;
    }

    public function get_error() {
        return $this->error;
    }
}
