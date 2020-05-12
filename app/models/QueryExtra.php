<?php

class QueryExtra extends Model
{

    protected $db;
    protected $error;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function get_total_cup_harian($hari)
    {
        $query = '
            SELECT 
                count(Pesanan.idMenu)
            FROM 
                transaksipemesanan
                JOIN Pesanan ON transaksipemesanan.id = Pesanan.idTransaksi
            WHERE
                transaksipemesanan.tanggal_transaksi = ' . $hari . ' 
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        if (!$queryResult) {
            $this->error = $this->db->get_error();

            echo $this->error;
            return false;
        }
        $result = $queryResult[0];
        return $result;
    }

    public function get_total_pemasukan_harian($hari)
    {
        $query = '
        SELECT 
            sum(total)
        FROM 
            transaksiPemesanan
        WHERE
            transaksipemesanan.tanggal_transaksi = ' . $hari . '
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        $result = $queryResult[0];
        if ($result['sum(total)'] != null) {
        } else {
            $result['sum(total)'] = 0;
        }
        return $result;
    }

    public function get_total_transaksi_harian($hari)
    {
        $query = '
        SELECT 
            count(id)
        FROM 
            transaksiPemesanan
        WHERE
            transaksipemesanan.tanggal_transaksi = ' . $hari . '
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        /*if (!$queryResult) {
            $this->error = $this->db->get_error();
            
            echo $this->error;
            return false;
        }*/

        $result = $queryResult[0];

        return $result;
    }

    //cari total seluruh 
    public function get_total_cup()
    {
        $query = '
        SELECT 
            count(Pesanan.idMenu)
        FROM 
            transaksipemesanan
            JOIN Pesanan ON transaksipemesanan.id = Pesanan.idTransaksi
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        /*if (!$queryResult) {
            $this->error = $this->db->get_error();

            echo $this->error;
            return false;
        }*/
        $result = $queryResult[0];
        return $result;
    }

    public function get_total_transaksi()
    {
        $query = '
        SELECT 
            count(id)
        FROM 
            transaksiPemesanan
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        $result = $queryResult[0];

        return $result;
    }

    public function get_total_pemasukan()
    {
        $query = '
        SELECT 
            sum(total)
        FROM 
            transaksiPemesanan
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        $result = $queryResult[0];
        if ($result['sum(total)'] != null) {
        } else {
            $result['sum(total)'] = 0;
        }
        return $result;
    }

    /*public function get_popular_menu()
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
    }*/

    //list rank 
    public function get_kasir_rank($bulanAwal, $bulanAkhir, $orderby = '')
    {
        $query = '
            SELECT 
            Pengguna.nama_pengguna, COUNT(transaksiBulanan.id) 
            FROM 
                Pengguna
                LEFT OUTER JOIN (
                SELECT *
                FROM TransaksiPemesanan
			    WHERE TransaksiPemesanan.tanggal_transaksi >= ' . $bulanAwal . ' and TransaksiPemesanan.tanggal_transaksi <= ' . $bulanAkhir . ')AS transaksiBulanan  
			    ON transaksiBulanan.idKasir = Pengguna.id
            WHERE 
                Pengguna.tipe = "kasir"
            GROUP BY 
                Pengguna.nama_pengguna
            ORDER BY 
                COUNT(transaksiBulanan.id) ' . $orderby . '
        ';
        $queryResult = $this->db->executeMultiQuery($query);
        $result = [];
        foreach ($queryResult[0] as $key => $value) {
            $result[] = [
                "nama" => $value['nama_pengguna'],
                "transaksi" => $value['COUNT(transaksiBulanan.id)']
            ];
        }
        return $result;
    }

    public function get_menu_rank($bulanAwal, $bulanAkhir, $orderby = '')
    {
        $query = '
        SELECT Menu.nama_minuman, COUNT(pesanan.idMenu) 
        FROM 
            pesanan 
            INNER JOIN 
                (select *
                from TransaksiPemesanan
                WHERE TransaksiPemesanan.tanggal_transaksi >= ' . $bulanAwal . ' and TransaksiPemesanan.tanggal_transaksi <= '  . $bulanAkhir . ') as transaksiBulanan
            ON transaksiBulanan.id = pesanan.idTransaksi
            RIGHT OUTER JOIN Menu 
            ON Menu.id = pesanan.idMenu
        GROUP BY 
            Menu.nama_minuman
        ORDER BY 
            COUNT(pesanan.idMenu) ' . $orderby . '
        ';

        $queryResult = $this->db->executeMultiQuery($query);
        /*if (!$queryResult) {
            $this->error = $this->db->get_error();
            
            echo $this->error;
            return false;
        }*/

        $result = [];
        foreach ($queryResult[0] as $key => $value) {
            $result[] = [
                "nama" => $value['nama_minuman'],
                "terjual" => $value['COUNT(pesanan.idMenu)']
            ];
        }
        return $result;
    }


    public function get_toping_rank($bulanAwal, $bulanAkhir, $orderby = '')
    {
        $query = '
            SELECT 
                Toping.nama_toping, COUNT(memilikiToping.idToping) 
            FROM 
                pesanan  
                INNER JOIN 
                        (select *
                        from TransaksiPemesanan
                        WHERE TransaksiPemesanan.tanggal_transaksi >= ' . $bulanAwal . ' and TransaksiPemesanan.tanggal_transaksi <= ' . $bulanAkhir . ') as transaksiBulanan
                        ON transaksiBulanan.id = pesanan.idTransaksi  INNER JOIN memilikiToping
                        ON memilikiToping.idpesanan = pesanan.id RIGHT OUTER JOIN toping
                        ON toping.id = memilikiToping.idToping
                GROUP BY 
                    Toping.nama_toping
                ORDER BY 
                    COUNT(memilikiToping.idToping)  ' . $orderby . '
        ';
        $queryResult = $this->db->executeMultiQuery($query);
        $result = [];
        foreach ($queryResult[0] as $key => $value) {
            $result[] = [
                "nama" => $value['nama_toping'],
                "terjual" => $value['COUNT(memilikiToping.idToping)']
            ];
        }
        return $result;
    }

    //cari rank no 1
    public function get_top_toping($bulanAwal, $bulanAkhir, $top = 1)
    {
        $query = '
            SELECT 
                Toping.nama_toping, COUNT(memilikiToping.idToping) 
            FROM 
                pesanan  
                INNER JOIN 
                    (select *
                    from TransaksiPemesanan
                    WHERE TransaksiPemesanan.tanggal_transaksi >= ' . $bulanAwal . ' and TransaksiPemesanan.tanggal_transaksi <= ' . $bulanAkhir . ') as transaksiBulanan
                ON transaksiBulanan.id = pesanan.idTransaksi  INNER JOIN memilikiToping
                ON memilikiToping.idpesanan = pesanan.id RIGHT OUTER JOIN toping
                ON toping.id = memilikiToping.idToping
            GROUP BY 
                Toping.nama_toping
            ORDER BY 
                COUNT(memilikiToping.idToping)  DESC
            LIMIT ' . $top . '
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        $result = $queryResult[0];
        return $result;
    }

    public function get_top_menu($bulanAwal, $bulanAkhir, $top = 1)
    {
        $query = '
            SELECT Menu.nama_minuman, COUNT(pesanan.idMenu) 
            FROM 
                pesanan 
                INNER JOIN 
                    (select *
                    from TransaksiPemesanan
                    WHERE TransaksiPemesanan.tanggal_transaksi >= ' . $bulanAwal . ' and TransaksiPemesanan.tanggal_transaksi <= '  . $bulanAkhir . ') as transaksiBulanan
                ON transaksiBulanan.id = pesanan.idTransaksi RIGHT OUTER JOIN Menu 
                ON Menu.id = pesanan.idMenu
            GROUP BY 
                Menu.nama_minuman
            ORDER BY 
                COUNT(pesanan.idMenu) DESC
            LIMIT ' . $top . '
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        /*if (!$queryResult) {
            $this->error = $this->db->get_error();
            
            echo $this->error;
            return false;
        }*/

        $result = $queryResult[0];
        return $result;
    }

    public function get_top_kasir($bulanAwal, $bulanAkhir, $top = 1)
    {
        $query = '
            SELECT 
                Pengguna.nama_pengguna, COUNT(transaksiBulanan.id) 
            FROM 
                Pengguna
                LEFT OUTER JOIN (
                SELECT *
                FROM TransaksiPemesanan
			    WHERE TransaksiPemesanan.tanggal_transaksi >= ' . $bulanAwal . ' and TransaksiPemesanan.tanggal_transaksi <= ' . $bulanAkhir . ')AS transaksiBulanan  
			    ON transaksiBulanan.idKasir = Pengguna.id
            WHERE 
                Pengguna.tipe = "kasir"
            GROUP BY 
                Pengguna.nama_pengguna
            ORDER BY 
                COUNT(transaksiBulanan.id) DESC
            LIMIT ' . $top . '
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        $result = $queryResult[0];

        return $result;
    }
}
