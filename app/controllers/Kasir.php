<?php

require_once MODEL_PATH . 'User.php';

class Kasir extends Controller
{
    public function __construct() {
        if(!isset($_SESSION['kasir']['page_state'])) {
            $_SESSION['kasir']['page_state'] = 0;
        }

        if(isset($_POST['back'])) {
            $this->go_back();
        }

        if(isset($_POST['set_page'])) {
            $this->set_page($_POST['set_page']);
        }

        if(isset($_POST['customer_name'])) {
            $this->set_customer($_POST['customer_name']);
        }

        if(isset($_POST['checkout_done'])) {
            $this->clear_customer_data();
            $this->set_page(0);
        }
    }

    public function index() {
        $data = json_decode(file_get_contents('php://input'), true);
        $auth = $this::auth_helper();
        $user = $auth->get_auth();

        if(isset($data)) {
            if($user) {
                if (strtolower($user['tipe']) == 'kasir') {
                    return $this->receive_json($data);
                }           
                else {
                    echo 'wrong auth';
                    $auth->logout();
                }
            }
            else {
                echo 'require correct authentication';
            }
        }
        else {
            if($user) {
                if (strtolower($user['tipe']) == 'kasir') {
                    $this::set_user($user);
                    return $this->page_kasir();
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
    }
    
    public function set_page($pageNumber) {
        $_SESSION['kasir']['page_state'] = $pageNumber;
    }

    public function set_customer($name) {
        $_SESSION['kasir']['customer_name'] = $name;
    }

    public function get_customer() {
        return $_SESSION['kasir']['customer_name'];;
    }

    public function clear_customer_data() {
        unset($_SESSION['kasir']);
    }

    public function set_selected_menu($menu) {
        $_SESSION['kasir']['selected_menu'] = $menu;
    }

    public function get_selected_menu() {
        if(isset($_SESSION['kasir']['selected_menu'])) {
            return $_SESSION['kasir']['selected_menu'];
        }
        else {
            return false;
        }
    }

    public function go_back() {
        if($_SESSION['kasir']['page_state'] > 0) {
            $_SESSION['kasir']['page_state'] -= 1;
        }
        else {
            $_SESSION['kasir']['page_state'] = 0;
        }
    }

    private function receive_json($data) {
        $result = [];

        if(isset($data['menu']) && count($data['menu']) > 0){
            $this->set_selected_menu($data['menu']);
            $result['code'] = 200;
            $result['text'] = 'success';
        }

        if(isset($data['checkout']) && count($data['checkout']) > 0) {
            require_once MODEL_PATH . 'Transaction.php';
            $transaction = new Transaction();

            $cashier_id = $this::get_user()['id'];
            $customer = $this->get_customer();
            $total = $data['checkout']['total'];
            $order = $data['checkout']['order'];

            $res = $transaction->insertTransaction($cashier_id, $customer, $total);

            if($res) {
                $transaction_id = $res[0][0]['LAST_INSERT_ID()'];
                $status;

                foreach($order as $menu_key => $menu) {
                    $menu_id = $menu['id'];
                    $size = $menu['size'];
                    $ice = $menu['ice'];
                    $sugar = $menu['sugar'];

                    foreach($menu['topping'] as $topping_key => $topping) {
                        $topping_id = $topping['id'];
                        $status = $transaction->insertDetailTransaction($transaction_id, $menu_id, $topping_id, $size, $ice, $sugar);
                    }

                    if(!$status) {
                        $result['code'] = 200;
                        $result['text'] = [
                            'error' => $transaction->get_error()
                        ];
                        break;
                    }
                }

                $result['code'] = 200;
                $result['text'] = 'success';
            }
            else {
                $result['code'] = 200;
                $result['text'] = $transaction->get_error();
            }

        }
        
        echo json_encode($result);
    }
    
    private function page_kasir()
    {
        switch($_SESSION['kasir']['page_state']) {
            case 0:
                $this->enterCustomerName();
            break;
            case 1:
                $this->SelectMenu();
            break;
            case 2:
                $this->selectSizeToppingIce();
            break;
            case 3:
                $this->checkout();
            break;
            default:
                $this->enterCustomerName();
            break;
        }
    }

    private function enterCustomerName()
    {
        $page = $this::create_page('kasir', 'enterCustomerName');
        
        $page->user_information = $this->get_user();

        $page->render();
    }

    private function selectMenu()
    {
        $page = $this::create_page('kasir', 'selectMenu');
        require_once MODEL_PATH . 'QueryMenu.php';
        $menu = new QueryMenu();

        $page->user_information = $this::get_user();
        $page->menu = $menu->get_all_menu();
        if($this->get_selected_menu()) {
            $page->selected_menu = json_encode($this->get_selected_menu());
        }
        $page->customer_name = $_SESSION['kasir']['customer_name'];

        $page->render();
    }

    private function selectSizeToppingIce() {
        $page = $this::create_page('kasir', 'selectSizeToppingIce');
        require_once MODEL_PATH . 'QueryToping.php';
        $topping = new QueryToping();

        $page->topping = $topping->get_all_topping();
        $page->selected_menu = json_encode($this->get_selected_menu());
        $page->user_information = $this::get_user();
        $page->customer_name = $this->get_customer();

        $page->render();
    }

    private function checkout() {
        $page = $this::create_page('kasir', 'checkout');

        $page->selected_menu = json_encode($this->get_selected_menu());
        $page->user_information = $this::get_user();
        $page->customer_name = $this->get_customer();
        $page->render();
    }
}
