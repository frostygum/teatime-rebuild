<?php

require_once MODEL_PATH . 'Toping.php';
class Manager extends Controller
{
    protected $db;
    
    public function __construct()
    {
        $this->db = new DB();
    }

    public function index()
    {
        $auth = $this::auth_helper();
        $user = $auth->get_auth();

        if($user) {
            if (true) {
                // $this::set_user($user);
                return $this->page_manager();
            }           
            else {
                echo 'wrong auth';
                $auth->logout();
            }         
        }
        else {
            $this::set_redirect_url();
            header('location: ./login');
        }
        
    }

    public function page_manager() {
        if(isset($_GET['page'])) {
            switch($_GET['page']) {
                case 'dashboard':
                    $this->page_dashboard();
                break;
                case 'data':
                    $this->page_data();
                break;
                case 'ranking':
                    $this->page_ranking();
                break;
                default:
                    $this->page_dashboard();
                break;
            }
        }
        else {
            header('location: ./manager?page=dashboard');
        }
    }

    public function page_dashboard() {
        $page = $this::create_page('manager', 'dashboard');

        $page->user_information = $this::get_user();
        $page->render();
    }

    public function page_data() {
        $page = $this::create_page('manager', 'data');

        $page->user_information = $this::get_user();
        $page->render();
    }
    
    public function page_ranking() {
        $page = $this::create_page('manager', 'ranking');

        $page->user_information = $this::get_user();
        $page->render();
    }
    
    /*public function index()
    {
        //$page->test = 'hai';
        
        $auth = $this::auth_helper();
        $user = $auth->get_auth();

        if ($user) {
            if (strtolower($user['tipe']) == 'manager') {
                $page = $this::create_page('manager', 'index');
                $page->user_information = $user;
                $page->render();
            } else {
                echo 'wrong auth';
                $auth->logout();
            }
        } else {
            $this::set_redirect_url();
            header('location: ./login');
        }
    }*/

    public function get_total_cupHarian(){
        $query = '
            SELECT 
                count(id)
            FROM 
                transaksi 
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        return $queryResult;
    }

    public function get_total_pemasukanHarian(){
        $query = '
        select 
            sum(total)
        from 
            TransaksiPemesanan
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        return $queryResult;
    }

    public function get_total_transaksiHarian(){
        $query = '
        select 
            count(id)
        from 
            TransaksiPemesanan
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        
        return $queryResult;
    }

    public function get_data_Transaksi(){
        $query = '
        SELECT 
            id, waktu_transaksi, nama_pemesan,nama_minuman, nama_toping, ukuran_gelas, banyak_es,banyak_gula,total
        FROM 
            transaksi
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        $result = [];
        foreach ($queryResult as $key => $value) {
            $result[] = new Transaction($value['id'], $value['waktu_transaksi'], $value['nama_pemesan'], 
                $value['nama_minuman'], $value['nama_toping'], $value['ukuran_gelas'],  
                $value['banyak_es'], $value['banyak_gula'], $value['total']);
        }
        return $result;
    }
    /*
    public function get_best_kasir{
        
        $query ='
            SELECT 
                Pengguna.nama_pengguna, 
                COUNT(TransaksiPemesanan.id) as "banyak transaksi"
            FROM TransaksiPemesanan join Pengguna
                on TransaksiPemesanan.idKasir = Pengguna.id
            GROUP BY Pengguna.nama_pengguna
            order by Pengguna.nama_pengguna
        ';
        $queryResult = $this->db->executeSelectQuery($query);
        $result = [];
        foreach ($queryResult as $key => $value) {
            $result[] = new Transaction($value[], $value[]);
        }
        return $result;
        
    }
    */
}
