<?php

class QueryExtra extends Model {
    
    public function get_total_cup_harian($hari){
        $query = '
            SELECT 
                detailtransaksi.idMenu
            FROM 
                transaksipemesanan
                JOIN detailtransaksi ON transaksi.id = detailtransaksi.idTransaksi
            WHERE
                transaksipemasanan.tanggal_transaksi = '. $hari .'
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        return $queryResult;
    }

    public function get_total_pemasukan_harian($hari){
        $query = '
        SELECT 
            sum(total)
        FROM 
            transaksiPemesanan
        WHERE
            transaksipemasanan,tanggal_transaksi = '. $hari .'
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        return $queryResult;
    }

    public function get_total_transaksi_harian($hari){
        $query = '
        SELECT 
            count(id)
        FROM 
            transaksiPemesanan
        WHERE
            transaksipemasanan,tanggal_transaksi = '. $hari .'
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        
        return $queryResult;
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
    }

    public function get_kasir_rank($bulanAwal, $bulanAkhir, $orderby = '')
    {
        $query = '
            SELECT 
                Pengguna.nama_pengguna, COUNT(TransaksiPemesanan.id) AS `banyak transaksi`
            FROM 
                TransaksiPemesanan 
                RIGHT OUTER JOIN Pengguna ON TransaksiPemesanan.idKasir = Pengguna.id
            WHERE 
                Pengguna.tipe = `kasir` AND TransaksiPemesanan.tanggal_transaksi >= '. $bulanAwal .' and TransaksiPemesanan.tanggal_transaksi <= '. $bulanAkhir .'
            GROUP BY 
                Pengguna.nama_pengguna
            ORDER BY 
                COUNT(TransaksiPemesanan.id) '. $orderby .'
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        return $queryResult;
    }

    public function get_menu_rank($bulanAwal, $bulanAkhir, $orderby = '')
    {
        $query = '
            SELECT 
                Menu.nama_minuman, COUNT(DetailTransaksi.idMenu) AS `banyak pembelian`
            FROM 
                DetailTransaksi 
                RIGHT OUTER JOIN Menu ON Menu.id = DetailTransaksi.idMenu
                INNER JOIN TransaksiPemesanan ON TransaksiPemesanan.id = DetailTransaksi.idTransaksi
            WHERE 
                TransaksiPemesanan.tanggal_transaksi >= '. $bulanAwal .' and TransaksiPemesanan.tanggal_transaksi <= '. $bulanAkhir .'
            GROUP BY 
                Menu.nama_minuman
            ORDER BY 
                COUNT(DetailTransaksi.idMenu) '. $orderby .'
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        return $queryResult ;
    }

    public function get_toping_rank($bulanAwal, $bulanAkhir, $orderby = '')
    {
        $query = '
            SELECT 
                Toping.nama_toping, COUNT(DetailTransaksi.idToping) as `banyak pembelian`
            FROM 
                DetailTransaksi 
                RIGHT OUTER JOIN Toping ON Toping.id = DetailTransaksi.idToping
                INNER JOIN TransaksiPemesanan ON TransaksiPemesanan.id = DetailTransaksi.idTransaksi
            WHERE 
                TransaksiPemesanan.tanggal_transaksi >= '. $bulanAwal .' and TransaksiPemesanan.tanggal_transaksi <= '. $bulanAkhir .'
            GROUP BY 
                Toping.nama_toping
            ORDER BY 
                COUNT(DetailTransaksi.idToping) '. $orderby .'
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        return $queryResult;
    }

    public function get_top_toping($bulanAwal, $bulanAkhir, $top = 1)
    {
        $query = '
            SELECT 
                TOP '. $top .' nama_toping
            FROM 
                DetailTransaksi 
                RIGHT OUTER JOIN Toping ON Toping.id = DetailTransaksi.idToping
                INNER JOIN TransaksiPemesanan ON TransaksiPemesanan.id = DetailTransaksi.idTransaksi
            WHERE 
                tanggal_transaksi >= '. $bulanAwal .' and tanggal_transaksi <= '. $bulanAkhir .'
            GROUP BY 
                nama_toping
            ORDER BY 
                COUNT(id) desc
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        return $queryResult;
    }

    public function get_top_menu($bulanAwal, $bulanAkhir, $top = 1)
    {
        $query = '
            SELECT 
                TOP '. $top .' nama_minuman
            FROM 
                DetailTransaksi 
                RIGHT OUTER JOIN Menu ON Menu.id = DetailTransaksi.idMenu
                INNER JOIN TransaksiPemesanan ON TransaksiPemesanan.id = DetailTransaksi.idTransaksi
            WHERE 
                tanggal_transaksi >= '. $bulanAwal .' and tanggal_transaksi <= '. $bulanAkhir .'
            GROUP BY 
                nama_minuman
            ORDER BY 
                COUNT(id) desc
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        return $queryResult;
    }

    public function get_top_kasir($bulanAwal, $bulanAkhir, $top = 1)
    {
        $query = '
            SELECT 
                TOP '. $top .' Pengguna.nama_pengguna
            FROM 
                TransaksiPemesanan 
                INNER JOIN Pengguna ON TransaksiPemesanan.idKasir = Pengguna.id
            WHERE 
                tanggal_transaksi >= '. $bulanAwal .' and tanggal_transaksi <= '. $bulanAkhir .'
            GROUP BY 
                Pengguna.nama_pengguna
            ORDER BY 
                COUNT(id) desc
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        return $queryResult;
    }
}