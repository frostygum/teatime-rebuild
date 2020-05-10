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
        
        require_once MODEL_PATH . 'Transaction.php';
        $transaction = new Transaction();

        $page->totalTransaksi = $transaction->get_total_transaksiHarian();
        $page->totalCup = $transaction->get_total_cupHarian();
        $page->totalPemasukan = $transaction->get_total_pemasukanHarian();

        $page->user_information = $this::get_user();
        $page->render();
    }

    public function page_data() {
        $page = $this::create_page('manager', 'data');
        require_once MODEL_PATH . 'Transaction.php';
        $transaction = new Transaction();

        $page->dataTransaksi = $transaction->get_data_Transaksi();

        $page->user_information = $this::get_user();
        $page->render();
    }
    
    public function page_ranking() {
        $page = $this::create_page('manager', 'ranking');
        require_once MODEL_PATH . 'Transaction.php';
        $transaction = new Transaction();

        $page->listPopularitasMenu = $transaction->get_menuPopular_list();

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

}
