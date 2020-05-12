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

    public function get_all_transaksi()
    {
        $query = '
        SELECT 
            TransaksiPemesanan.id, TransaksiPemesanan.waktu_transaksi , TransaksiPemesanan.nama_pemesan, menu.nama_minuman, 
		    toping.nama_toping, DetailTransaksi.ukuran_gelas, DetailTransaksi.banyak_es, DetailTransaksi.banyak_gula, TransaksiPemesanan.total
        FROM detailtransaksi 
            JOIN transaksipemesanan ON transaksipemesanan.id = detailtransaksi.idTransaksi 
            JOIN menu ON menu.id = detailtransaksi.idMenu JOIN toping ON toping.id = detailtransaksi.idToping 
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        $result = [];
        foreach ($queryResult as $key => $value) {
            $result[] = [
                "id" => $value['id'],
                "waktu_transaksi" => $value['waktu_transaksi'],
                "nama_pemesan" => $value['nama_pemesan'],
                "nama_minuman" => $value['nama_minuman'],
                "nama_toping" => $value['nama_toping'],
                "ukuran_gelas" => $value['ukuran_gelas'],
                "banyak_es" => $value['banyak_es'],
                "banyak_gula" => $value['banyak_gula'],
                "total" => $value['total']
            ];
        }
        return $result;
    }

    public function get_all_transaksi_by_date($date)
    {
        $query = '
        SELECT 
            TransaksiPemesanan.id, TransaksiPemesanan.waktu_transaksi , TransaksiPemesanan.nama_pemesan, menu.nama_minuman, 
		    toping.nama_toping, DetailTransaksi.ukuran_gelas, DetailTransaksi.banyak_es, DetailTransaksi.banyak_gula, TransaksiPemesanan.total
        FROM detailtransaksi 
            JOIN transaksipemesanan ON transaksipemesanan.id = detailtransaksi.idTransaksi 
            JOIN menu ON menu.id = detailtransaksi.idMenu JOIN toping ON toping.id = detailtransaksi.idToping 
        WHERE TransaksiPemesanan.tanggal_transaksi = ' . $date . '
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        var_dump($queryResult);
        if (!$queryResult) {
            $this->error = $this->db->get_error();
            
            echo $this->error;
            return false;
        }
        $result = [];
        foreach ($queryResult as $key => $value) {
            $result[] = [
                "id" => $value['id'],
                "waktu_transaksi" => $value['waktu_transaksi'],
                "nama_pemesan" => $value['nama_pemesan'],
                "nama_minuman" => $value['nama_minuman'],
                "nama_toping" => $value['nama_toping'],
                "ukuran_gelas" => $value['ukuran_gelas'],
                "banyak_es" => $value['banyak_es'],
                "banyak_gula" => $value['banyak_gula'],
                "total" => $value['total']
            ];
        }
        return $result;
    }

    public function get_transaksi_by_id($id)
    {
        $id = $this->db->escapeString($id);

        $query = '
        SELECT 
            TransaksiPemesanan.id, TransaksiPemesanan.waktu_transaksi , TransaksiPemesanan.nama_pemesan, menu.nama_minuman, 
            toping.nama_toping, DetailTransaksi.ukuran_gelas, DetailTransaksi.banyak_es, DetailTransaksi.banyak_gula, TransaksiPemesanan.total
        FROM detailtransaksi 
            JOIN transaksipemesanan ON transaksipemesanan.id = detailtransaksi.idTransaksi 
            JOIN menu ON menu.id = detailtransaksi.idMenu JOIN toping ON toping.id = detailtransaksi.idToping 
        WHERE 
            id = ' . $id . '
        ';

        $queryResult = $this->db->executeSelectQuery($query);
        $result[] = [
            "id" => $queryResult['id'],
            "waktu_transaksi" => $queryResult['waktu_transaksi'],
            "nama_pemesan" => $queryResult['nama_pemesan'],
            "nama_minuman" => $queryResult['nama_minuman'],
            "nama_toping" => $queryResult['nama_toping'],
            "ukuran_gelas" => $queryResult['ukuran_gelas'],
            "banyak_es" => $queryResult['banyak_es'],
            "banyak_gula" => $queryResult['banyak_gula'],
            "total" => $queryResult['total']
        ];
        return $result;
    }

    public function delete_transaction($id)
    {
        $id = $this->db->escapeString($id);

        $query = "
            DELETE FROM Transaction
            WHERE id = '$id'
        ";

        $query_result = $this->db->executeNonSelectQuery($query);

        if (!$query_result) {
            $this->error = $this->db->get_error();
            return false;
        }

        return true;
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
}
