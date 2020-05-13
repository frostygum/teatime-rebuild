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
            TransaksiPemesanan.id, 
            TransaksiPemesanan.waktu_transaksi, 
            TransaksiPemesanan.nama_pemesan, 
            menu.nama_minuman, 
            toping.nama_toping, 
            pesanan.ukuran_gelas, 
            pesanan.banyak_es, 
            pesanan.banyak_gula, 
            TransaksiPemesanan.total
        FROM pesanan 
            JOIN transaksipemesanan ON transaksipemesanan.id = pesanan.idTransaksi 
            JOIN menu ON menu.id = pesanan.idMenu 
            LEFT JOIN memilikitoping ON memilikitoping.idPesanan = pesanan.id
            LEFT JOIN toping ON toping.id = memilikitoping.idToping 
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
        $date = $this->db->escapeString($date);

        $query = '
        SELECT 
            TransaksiPemesanan.id, 
            TransaksiPemesanan.waktu_transaksi, 
            TransaksiPemesanan.nama_pemesan, 
            menu.nama_minuman, 
            toping.nama_toping, 
            pesanan.ukuran_gelas, 
            pesanan.banyak_es, 
            pesanan.banyak_gula, 
            TransaksiPemesanan.total
        FROM pesanan 
            JOIN transaksipemesanan ON transaksipemesanan.id = pesanan.idTransaksi 
            JOIN menu ON menu.id = pesanan.idMenu 
            LEFT JOIN memilikitoping ON memilikitoping.idPesanan = pesanan.id
            LEFT JOIN toping ON toping.id = memilikitoping.idToping 
        WHERE 
            TransaksiPemesanan.tanggal_transaksi = ' . $date . '
        ';
        $queryResult = $this->db->executeSelectQuery($query);

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

    public function get_transaksi_by_date($date)
    {
        $date = $this->db->escapeString($date);

        $query = '
        SELECT 
            TransaksiPemesanan.id, 
            TransaksiPemesanan.waktu_transaksi, 
            TransaksiPemesanan.nama_pemesan, 
            COUNT(pesanan.idMenu), 
            TransaksiPemesanan.total
        FROM pesanan 
            JOIN transaksipemesanan ON transaksipemesanan.id = pesanan.idTransaksi  
        WHERE 
            TransaksiPemesanan.tanggal_transaksi = ' . $date . '
        GROUP BY 
            TransaksiPemesanan.id,
            TransaksiPemesanan.waktu_transaksi, 
            TransaksiPemesanan.nama_pemesan,
            TransaksiPemesanan.total
        ';
        $queryResult = $this->db->executeSelectQuery($query);
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
                "jumlah" => $value['COUNT(pesanan.idMenu)'],
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
                TransaksiPemesanan.id, 
                TransaksiPemesanan.waktu_transaksi, 
                TransaksiPemesanan.nama_pemesan, menu.nama_minuman, 
                toping.nama_toping, 
                pesanan.ukuran_gelas, 
                pesanan.banyak_es, 
                pesanan.banyak_gula, 
                TransaksiPemesanan.total
            FROM pesanan 
                JOIN transaksipemesanan ON transaksipemesanan.id = pesanan.idTransaksi 
                JOIN menu ON menu.id = pesanan.idMenu JOIN toping ON toping.id = pesanan.idToping 
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
        $id_cashier = $this->db->escapeString($id_cashier);
        $customer_name = $this->db->escapeString($customer_name);
        $total = $this->db->escapeString($total);

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

    public function insertOrder($transaction_id, $menu_id, $size, $ice, $sugar)
    {
        $transaction_id = $this->db->escapeString($transaction_id);
        $menu_id = $this->db->escapeString($menu_id);
        $size = $this->db->escapeString($size);
        $sugar = $this->db->escapeString($sugar);

        $query = "
            INSERT INTO 
                `pesanan` 
                (
                    `idTransaksi`, 
                    `idMenu`,
                    `banyak_es`, 
                    `banyak_gula`, 
                    `ukuran_gelas`
                ) 
            VALUES
            (
                $transaction_id, 
                $menu_id,  
                '$ice', 
                '$sugar', 
                '$size'
            );
            SELECT LAST_INSERT_ID();
        ";

        $query_result = $this->db->executeMultiQuery($query);

        if (!$query_result) {
            return false;
        }

        return $query_result;
    }

    public function insertOrderToping($orderId, $topingId) {
        $orderId = $this->db->escapeString($orderId);
        $topingId = $this->db->escapeString($topingId);

        $query = "
            INSERT INTO 
                `memilikitoping` 
                (
                    `idPesanan`, 
                    `idToping`
                ) 
            VALUES
            (
                $orderId,
                $topingId
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
