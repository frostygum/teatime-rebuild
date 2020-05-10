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
}