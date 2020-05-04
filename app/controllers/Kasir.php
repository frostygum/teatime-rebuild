<?php

require_once MODEL_PATH . 'User.php';

class Kasir extends Controller
{
    public function __construct() {
        if(!isset($_SESSION['kasir']['page_state'])) {
            $_SESSION['kasir']['page_state'] = 0;
        }

        if(isset($_POST['back'])) {
            $this->goBack();
        }

        if(isset($_POST['set_page'])) {
            $this->setPage($_POST['set_page']);
        }
    }
    
    public function setPage($pageNumber) {
        $_SESSION['kasir']['page_state'] = $pageNumber;
    }

    public function goBack() {
        if($_SESSION['kasir']['page_state'] > 0) {
            $_SESSION['kasir']['page_state'] -= 1;
        }
        else {
            $_SESSION['kasir']['page_state'] = 0;
        }
    }
    
    public function page_kasir()
    {
        $auth = $this::auth_helper();
        $user = $auth->get_auth();

        if(isset($_POST['customer_name'])) {
            $_SESSION['kasir']['customer_name'] = $_POST['customer_name'];
        }

        if ($user) {
            if (strtolower($user['tipe']) == 'kasir') {
                switch($_SESSION['kasir']['page_state']) {
                    case 0:
                        $this->enterCustomerName($user);
                    break;
                    case 1:
                        $this->SelectMenu($user);
                    break;
                    default:
                        $this->enterCustomerName($user);
                    break;
                }
            } else {
                echo 'wrong auth';
                $auth->logout();
            }
        } else {
            $this::set_redirect_url();
            header('location: ./login');
        }
    }

    public function enterCustomerName($user)
    {
        $page = $this::create_page('kasir', 'enterCustomerName');
        $page->user_information = $user;
        $page->render();
    }

    public function selectMenu($user)
    {
        $page = $this::create_page('kasir', 'selectMenu');
        $page->user_information = $user;
        $page->customer_name = $_SESSION['kasir']['customer_name'];
        $page->render();
    }
}
