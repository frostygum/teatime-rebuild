<?php

class PageError extends Controller {
    function page_error_not_found_or_wrong_method() {
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            $page = $this::create_page('error', 'ErrorWrongMethod');
            $page->render();
        }
        else {
            echo 'Error: Page not found or wrong method';
        }
    }
}