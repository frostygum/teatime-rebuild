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
                count(detailtransaksi.idMenu)
            FROM 
                transaksipemesanan
                JOIN detailtransaksi ON transaksipemesanan.id = detailtransaksi.idTransaksi
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
                count(detailtransaksi.idMenu)
            FROM 
                transaksipemesanan
                JOIN detailtransaksi ON transaksipemesanan.id = detailtransaksi.idTransaksi
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

    public function get_popular_menu()
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
    }

    //list rank
    public function get_kasir_rank($bulanAwal, $bulanAkhir, $orderby = '')
    {
        $query = '
        SELECT 
        Pengguna.nama_pengguna, COUNT(pesanan.id) 
        FROM 
            Pengguna
            LEFT OUTER JOIN (
            SELECT *
            FROM TransaksiPemesanan
        WHERE TransaksiPemesanan.tanggal_transaksi >= ' . $bulanAwal . ' and TransaksiPemesanan.tanggal_transaksi <= ' . $bulanAkhir . ')AS pesanan  
        ON pesanan.idKasir = Pengguna.id
        WHERE 
            Pengguna.tipe = "kasir"
        GROUP BY 
            Pengguna.nama_pengguna
        ORDER BY 
            COUNT(pesanan.id) ' . $orderby . '
        ';
        $queryResult = $this->db->executeMultiQuery($query);
        $result = [];
        foreach ($queryResult[0] as $key => $value) {
            $result[] = [
                "nama" => $value['nama_pengguna'],
                "transaksi" => $value['COUNT(pesanan.id)']
            ];
        }
        return $result;
    }

    public function get_menu_rank($bulanAwal, $bulanAkhir, $orderby = '')
    {
        $query = '
        SELECT Menu.nama_minuman, COUNT(DetailTransaksi.idMenu) 
        FROM 
            DetailTransaksi 
            INNER JOIN 
                (select *
                from TransaksiPemesanan
                WHERE TransaksiPemesanan.tanggal_transaksi >= "' . $bulanAwal . '" and TransaksiPemesanan.tanggal_transaksi <= "' . $bulanAkhir . '") as pemesanan
            ON pemesanan.id = DetailTransaksi.idTransaksi
            RIGHT OUTER JOIN Menu 
            ON Menu.id = DetailTransaksi.idMenu
            
        GROUP BY 
            Menu.nama_minuman
        ORDER BY 
            COUNT(DetailTransaksi.idMenu) ' . $orderby . '
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
                "terjual" => $value['COUNT(DetailTransaksi.idMenu)']
            ];
        }
        return $result;
    }


    public function get_toping_rank($bulanAwal, $bulanAkhir, $orderby = '')
    {
        $query = '
            SELECT 
                Toping.nama_toping, COUNT(DetailTransaksi.idToping) 
            FROM 
                DetailTransaksi  
                INNER JOIN 
                    (select *
                    from TransaksiPemesanan
                    WHERE TransaksiPemesanan.tanggal_transaksi >= ' . $bulanAwal . ' and TransaksiPemesanan.tanggal_transaksi <= ' . $bulanAkhir . ') as pemesanan
                ON pemesanan.id = DetailTransaksi.idTransaksi
                RIGHT OUTER JOIN Toping ON Toping.id = DetailTransaksi.idToping
            GROUP BY 
                Toping.nama_toping
            ORDER BY 
                COUNT(DetailTransaksi.idToping) ' . $orderby . '
        ';
        $queryResult = $this->db->executeMultiQuery($query);
        $result = [];
        foreach ($queryResult[0] as $key => $value) {
            $result[] = [
                "nama" => $value['nama_toping'],
                "terjual" => $value['COUNT(DetailTransaksi.idToping)']
            ];
        }
        return $result;
    }

    //cari rank no 1
    public function get_top_toping($bulanAwal, $bulanAkhir, $top = 1)
    {
        $query = '
            SELECT 
                nama_toping
            FROM 
                DetailTransaksi 
                RIGHT OUTER JOIN Toping ON Toping.id = DetailTransaksi.idToping
                INNER JOIN TransaksiPemesanan ON TransaksiPemesanan.id = DetailTransaksi.idTransaksi
            WHERE 
                tanggal_transaksi >= ' . $bulanAwal . ' and tanggal_transaksi <= ' . $bulanAkhir . '
            GROUP BY 
                nama_toping
            ORDER BY 
                COUNT(DetailTransaksi.idToping) desc
            LIMIT '.$top.'
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        $result = $queryResult[0];
        return $result;
    }

    public function get_top_menu($bulanAwal, $bulanAkhir, $top = 1)
    {
        $query = '
        SELECT 
            nama_minuman
        FROM 
            DetailTransaksi 
            RIGHT OUTER JOIN Menu ON Menu.id = DetailTransaksi.idMenu
            INNER JOIN TransaksiPemesanan ON TransaksiPemesanan.id = DetailTransaksi.idTransaksi
        WHERE 
            tanggal_transaksi >= ' . $bulanAwal . ' and tanggal_transaksi <= ' . $bulanAkhir . '
        GROUP BY 
            nama_minuman
        ORDER BY 
            COUNT(DetailTransaksi.idMenu) desc
        LIMIT '.$top.'
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

    public function get_top_kasir($bulanAwal, $bulanAkhir, $top = 1)
    {
        $query = '
            SELECT 
                Pengguna.nama_pengguna
            FROM 
                TransaksiPemesanan 
                INNER JOIN Pengguna ON TransaksiPemesanan.idKasir = Pengguna.id
            WHERE 
                tanggal_transaksi >= ' . $bulanAwal . ' and tanggal_transaksi <= ' . $bulanAkhir . '
            GROUP BY 
                Pengguna.nama_pengguna
            ORDER BY 
                COUNT(TransaksiPemesanan.idKasir) desc
            LIMIT '.$top.'
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        $result = $queryResult[0];
        
        return $result;
    }
}
