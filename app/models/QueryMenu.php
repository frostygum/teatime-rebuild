<?php

require_once MODEL_PATH . 'Menu.php';

class QueryMenu extends Model
{
    protected $db;
    protected $error = null;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function get_all_menu()
    {
        $query = '
            SELECT
                id,
                nama_minuman,
                harga_regular,
                harga_large
            FROM
                Menu
        ';

        $queryResult = $this->db->executeSelectQuery($query);
        $result = [];

        if ($this->db->get_error() != null) {
            $this->error = $this->db->get_error();
            return false;
        } else {
            if (count($queryResult) != 0) {
                foreach ($queryResult as $key => $value) {
                    $result[] = new Menu($value['id'], $value['nama_minuman'], $value['harga_regular'], $value['harga_large']);
                }
            } else {
                $this->error = $this->db->get_error();
                return false;
            }
        }

        return $result;
    }

    public function get_menu_by_id($id)
    {
        $query = '
            SELECT
                id,
                nama_minuman,
                harga_regular,
                harga_large
            FROM
                Menu
            WHERE
                id = '. $id .'
        ';

        $queryResult = $this->db->executeSelectQuery($query);
        $result = [];

        if ($this->db->get_error() != null) {
            $this->error = $this->db->get_error();
            return false;
        } else {
            if (count($queryResult) != 0) {
                foreach ($queryResult as $key => $value) {
                    $result[] = new Menu($value['id'], $value['nama_minuman'], $value['harga_regular'], $value['harga_large']);
                }
            } else {
                $this->error = $this->db->get_error();
                return false;
            }
        }

        return $result;
    }

    public function get_menu_by_name($name)
    {
        $query = '
            SELECT
                id,
                nama_minuman,
                harga_regular,
                harga_large
            FROM
                Menu
            WHERE
                nama_minuman LIKE '. $name .'
        ';

        $queryResult = $this->db->executeSelectQuery($query);
        $result = [];

        if ($this->db->get_error() != null) {
            $this->error = $this->db->get_error();
            return false;
        } else {
            if (count($queryResult) != 0) {
                foreach ($queryResult as $key => $value) {
                    $result[] = new Toping($value['id'], $value['nama_toping'], $value['harga_toping']);
                }
            } else {
                $this->error = $this->db->get_error();
                return false;
            }
        }

        return $result;
    }

    public function update_menu($id, $name = null, $harga_r = null, $harga_l = null)
    {
        $id = $this->db->escapeString($id);
        $name = $this->db->escapeString($name);
        $harga_r = $this->db->escapeString($harga_r);
        $harga_l = $this->db->escapeString($harga_l);

        $query = "
            UPDATE 
                Menu
            SET
        ";

        if ($name != null) {
            $query .= " nama_minuman = '$name',";
        }
        if ($harga_r != null) {
            $query .= " harga_regular = '$harga_r',";
        }
        if ($harga_l != null) {
            $query .= " harga_large = '$harga_l',";
        }

        $query = substr($query, 0, -1);
        $query .= " WHERE id = '$id'";

        $query_result = $this->db->executeNonSelectQuery($query);

        if (!$query_result) {
            $this->error = $this->db->get_error();
            return false;
        }

        return true;
    }

    public function delete_menu($id)
    {
        $id = $this->db->escapeString($id);

        $query = "
            DELETE FROM Menu
            WHERE id = '$id'
        ";

        $query_result = $this->db->executeNonSelectQuery($query);

        if (!$query_result) {
            $this->error = $this->db->get_error();
            return false;
        }

        return true;
    }

    public function create_Menu($name, $harga_r, $harga_l)
    {
        $name = $this->db->escapeString($name);
        $harga_r = $this->db->escapeString($harga_r);
        $harga_l = $this->db->escapeString($harga_l);

        $query = "
            INSERT INTO Menu (
                nama_toping, harga_regular, harga_large 
            )
            VALUES (
                '$name', '$harga_r', '$harga_l'
            )
        ";

        $query_result = $this->db->executeNonSelectQuery($query);

        if (!$query_result) {
            $this->error = $this->db->get_error();
            return false;
        }

        return true;
    }

    public function get_error() {
        return $this->error;
    }
}
