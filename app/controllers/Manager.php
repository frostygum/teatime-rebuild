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

        if ($user) {
            if (strtolower($user['tipe']) == 'manager') {
                return $this->page_manager(); 
            } else {
                $auth->logout();
                $page = $this::create_page('error', 'ErrorWrongAuthUser');
                $page->render();
            }
        } else {
            $this->redirect('login');
        }
    }

    public function page_manager()
    {
        if (isset($_GET['page'])) {
            switch ($_GET['page']) {
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
        } else {
            header('location: ./manager?page=dashboard');
        }
    }

    public function page_dashboard()
    {
        $page = $this::create_page('manager', 'dashboard');
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Ymd');
        $firstDay = date('Ym01');
        $lastDay = date('Ym31');
        require_once MODEL_PATH . 'QueryExtra.php';
        $extra = new QueryExtra();
        //total
        $page->totalTransaksi = $extra->get_total_transaksi();
        $page->totalCup = $extra->get_total_cup();
        $page->totalPemasukan = $extra->get_total_pemasukan();

        //top
        $page->topMenu = $extra->get_top_menu($firstDay, $lastDay);
        $page->topToping = $extra->get_top_toping($firstDay, $lastDay);
        $page->topKasir = $extra->get_top_kasir($firstDay, $lastDay);

        $salePerMonth = [];
        //get data penjualan sebulan
        for($i = 1; $i < cal_days_in_month(CAL_GREGORIAN,2,date('Y')); $i++) {
            $day = $i;
            if(strlen($i) < 2) {
                $day = "0" . $i;
            }

            $date = date('Ym') . $day;

            $salePerThisMonth[] = [
                "day" => $day,
                "total" => $extra->get_total_cup_harian($date)['count(Pesanan.idMenu)']
            ];
        }
        $page->salePerThisMonth = json_encode($salePerThisMonth);


        $dataPerThisMonth = [];
        // get data transaksi sebulan
        for($i = 1; $i < cal_days_in_month(CAL_GREGORIAN,2,date('Y')); $i++) {
            $day = $i;
            if(strlen($i) < 2) {
                $day = "0" . $i;
            }

            $date = date('Ym') . $day;

            $dataPerThisMonth[] = [
                "day" => $day,
                "total" => $extra->get_total_pemasukan_harian($date)['sum(total)']
            ];
        }
        $page->dataPerThisMonth = json_encode($dataPerThisMonth);


        $page->user_information = $this::get_user();
        $page->render();
    }

    public function page_data()
    {
        $page = $this::create_page('manager', 'data');
        date_default_timezone_set('Asia/Jakarta');

        require_once MODEL_PATH . 'Transaction.php';
        $transaction = new Transaction();
        require_once MODEL_PATH . 'QueryExtra.php';
        $extra = new QueryExtra();

        if (isset($_POST['tgl'])) {
            // bisa tuh, stylenya antep aja dl hmm yudh nnt cri dlu itu knpp 
            $date = str_replace("-", "", $_POST['tgl']);
        } else {
            $date = date('Ymd');
        }

        //total
        $page->totalTransaksi = $extra->get_total_transaksi_harian($date);
        $page->totalCup = $extra->get_total_cup_harian($date);
        $page->totalPemasukan = $extra->get_total_pemasukan_harian($date);

        //data tabel
        $page->dataDetailTransaksi = $transaction->get_all_transaksi_by_date($date);
        $page->dataTransaksi = $transaction->get_transaksi_by_date($date);


        $page->user_information = $this::get_user();
        $page->render();
    }

    public function page_ranking()
    {
        $page = $this::create_page('manager', 'ranking');
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Ymd');
        $firstDay = date('Ym01');
        $lastDay = date('Ym31');
        require_once MODEL_PATH . 'QueryExtra.php';
        $extra = new QueryExtra();
        $page->listMenuDESC = $extra->get_menu_rank($firstDay, $lastDay, 'DESC');
        $page->listTopingDESC = $extra->get_toping_rank($firstDay, $lastDay, 'DESC');
        $page->listKasirDESC = $extra->get_kasir_rank($firstDay, $lastDay, 'DESC');

        $page->listMenuASC = $extra->get_menu_rank($firstDay, $lastDay, 'ASC');
        $page->listTopingASC = $extra->get_toping_rank($firstDay, $lastDay, 'ASC');
        $page->listKasirASC = $extra->get_kasir_rank($firstDay, $lastDay, 'ASC');

        $page->user_information = $this::get_user();
        $page->render();
    }
}
