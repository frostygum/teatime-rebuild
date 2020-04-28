<?php

class Auth extends Controller {
    public function loginPage() {
        $page = $this::create_page('login', 'index');
        $page->render(); 
    }

    public function authenticate() {
        $post = json_decode(file_get_contents('php://input'), true);
        $username = $post['username'];
        $password = $post['password'];
        $result = [];

        if($username && $password) {
            $db = new DB;
            $query_result = $db->executeSelectQuery("
                SELECT
                    id, username, tipe, password
                FROM 
                    pengguna
                WHERE   
                    username = '$username'
            ");
            if(isset($query_result[0]['error'])) {
                $result['code'] = '200';
                $result['text'] = $query_result[0]['error'];
            }
            else {
                if(password_verify($password, $query_result[0]['password'])) {
                    $result['id'] = $query_result[0]['id'];
                    $result['username'] = $query_result[0]['username'];
                    $result['tipe'] = $query_result[0]['tipe'];
    
                    return json_encode($result);
                }
                else {
                    $result['code'] = '200';
                    $result['text'] = 'unauthorize';
                }
            }
            return json_encode($result);
        }
    }
}