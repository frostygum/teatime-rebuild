<?php

class Transaction extends Model {
    protected $db;
    protected $error;
    
    public function __construct() {
        $this->db = new DB();
    }

    public function get_error() {
        return $this->get_error();
    }

    public function insertTransaction($id_cashier, $customer_name, $total) {
        date_default_timezone_set("Asia/Jakarta");

        $date = date("Y-m-d");
        $time = date("H:i:s");
        $query = "
            INSERT INTO 
                `transaksipemesanan` (
                    `idKasir`, 
                    `nama_pemesan`, 
                    `tanggal_transaksi`, 
                    `waktu_transaksi`, 
                    `total`
                ) 
            VALUES (
                $id_cashier, 
                '$customer_name', 
                '$date', 
                '$time', 
                $total
            );
            SELECT LAST_INSERT_ID();
        ";

        $query_result = $this->db->executeMultiQuery($query);
        
        if (!$query_result) {
            return false;
        }

        return $query_result;
    }

    public function insertDetailTransaction($transaction_id, $menu_id, $toping_id, $size, $ice, $sugar) {
        $query = "
            INSERT INTO 
                `detailtransaksi` 
                (
                    `idTransaksi`, 
                    `idMenu`, 
                    `idToping`, 
                    `banyak_es`, 
                    `banyak_gula`, 
                    `ukuran_gelas`
                ) 
            VALUES
            (
                $transaction_id, 
                $menu_id, 
                $toping_id, 
                '$ice', 
                '$sugar', 
                '$size'
            )
        ";

        $query_result = $this->db->executeNonSelectQuery($query);
        
        if (!$query_result) {
            $this->error = $this->db->get_error();
            return false;
        }

        return true;
    }

}