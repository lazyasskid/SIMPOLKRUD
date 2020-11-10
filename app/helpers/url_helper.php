<?php
    // Redirect Page Helper
    function redirect($page) {
        header('location: '. URL_ROOT . '/' . $page);
    }
