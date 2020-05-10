<?php

class Transaction extends Model
{
    protected $db;
    protected $error;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function get_error()
    {
        return $this->get_error();
    }

    public function insertTransaction($id_cashier, $customer_name, $total)
    {
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

    public function insertDetailTransaction($transaction_id, $menu_id, $toping_id, $size, $ice, $sugar)
    {
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

    public function get_total_cupHarian()
    {
        $query = '
            SELECT 
                count(id)
            FROM 
                transaksi 
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        $result = $queryResult[0];
        return $result;
    }

    public function get_total_pemasukanHarian()
    {
        $query = '
        select 
            sum(total)
        from 
            TransaksiPemesanan
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        $result = $queryResult[0];
        return $result;
    }

    public function get_total_transaksiHarian()
    {
        $query = '
        select 
            count(id)
        from 
            TransaksiPemesanan
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        $result = $queryResult[0];
        return $result;
    }

    public function get_data_Transaksi()
    {
        $query = '
        SELECT 
            id, waktu_transaksi, nama_pemesan,nama_minuman, 
            nama_toping, ukuran_gelas, banyak_es,banyak_gula,total
        FROM 
            transaksi
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        $result = [];
        foreach ($queryResult as $key => $value) {
            $result[] = [
                "date" => $value['waktu_transaksi'],
                "customer" => $value['nama_pemesan'],
                "order" => $value['nama_minuman'],
                "topping" => $value['nama_toping'],
                "size" => $value['ukuran_gelas'],
                "ice" => $value['banyak_es'],
                "sugar" => $value['banyak_gula'],
                "total" => $value['total']
            ];
        }
        return $result;
    }

    public function get_menuPopular_list()
    {
        $query = '
        SELECT 
            Menu.nama_minuman, COUNT(DetailTransaksi.idMenu) 
        FROM 
            DetailTransaksi RIGHT OUTER JOIN Menu
	            ON Menu.id = DetailTransaksi.idMenu
        GROUP BY 
            Menu.nama_minuman
        ORDER BY 
            COUNT(DetailTransaksi.idMenu) DESC
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        $result = [];
        foreach ($queryResult as $key => $value) {
            $result[] = [
                "nama" => $value['nama_minuman'],
                "terjual" => $value['COUNT(DetailTransaksi.idMenu)']
            ];
        }
        return $result;
        /*
        $queryResult = $this->db->executeSelectQuery($query);
        if (!$queryResult) {
            $this->error = $this->db->get_error();
            echo $this->db->get_error();
        } 
        return false;*/
        

    }
}
