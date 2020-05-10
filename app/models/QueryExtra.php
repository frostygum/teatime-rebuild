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
}