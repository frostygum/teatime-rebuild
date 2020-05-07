<?php

require_once MODEL_PATH . 'Menu.php';

class QueryMenu extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function get_all_menu() {
        $query = '
            SELECT
                id,
                nama_minuman,
                harga_regular,
                harga_large
            FROM
                menu
        ';

        $queryResult = $this->db->executeSelectQuery($query);
        $result = [];
        foreach ($queryResult as $key => $value) {
            $result[] = new Menu($value['id'], $value['nama_minuman'], $value['harga_regular'], $value['harga_large']);
        }

        return $result;
    }
}
