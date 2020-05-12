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
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Ymd');
        $firstDay = date('Ym01');
        $lastDay = date('Ym31');
        require_once MODEL_PATH . 'QueryExtra.php';
        $extra = new QueryExtra();
        //total
        $page->totalTransaksi = $extra->get_total_transaksi_harian($date);
        $page->totalCup = $extra->get_total_cup_harian($date);
        $page->totalPemasukan = $extra->get_total_pemasukan_harian($date);
        //top
        $page->topMenu = $extra->get_top_menu($firstDay, $lastDay);
        $page->topToping = $extra->get_top_toping($firstDay, $lastDay);
        $page->topKasir = $extra->get_top_kasir($firstDay, $lastDay);

        $page->user_information = $this::get_user();
        $page->render();
    }

    public function page_data() {
        $page = $this::create_page('manager', 'data');
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Ymd');
        require_once MODEL_PATH . 'Transaction.php';
        $transaction = new Transaction();

        $page->dataTransaksi = $transaction->get_all_transaksi_by_date($date);

        $page->user_information = $this::get_user();
        $page->render();
    }
    
    public function page_ranking() {
        $page = $this::create_page('manager', 'ranking');
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Ymd');
        $firstDay = date('Ym01');
        $lastDay = date('Ym31'); 
        require_once MODEL_PATH . 'QueryExtra.php';
        $extra = new QueryExtra();
        $page->listMenu = $extra->get_menu_rank($firstDay, $lastDay, 'DESC');
        $page->listToping = $extra->get_toping_rank($firstDay, $lastDay, 'DESC');
        $page->listKasir = $extra->get_kasir_rank($firstDay, $lastDay, 'DESC');

        $page->user_information = $this::get_user();
        $page->render();
    }
    
    

}
