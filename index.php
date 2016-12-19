<?php

session_start();

require 'model.php';

require 'controller.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = false;
    
    switch ($_POST['action']) {
        
        case 'lisa':
            $number     = $_POST['number'];
            $nimetus    = $_POST['nimetus'];
            $kategooria = intval($_POST['kategooria']);
            $result     = controller_add($number, $nimetus, $kategooria);
            break;
        
        case 'muuda':
            $id         = intval($_POST['id']);
            $number     = $_POST['number'];
            $nimetus    = $_POST['nimetus'];
            $kategooria = intval($_POST['kategooria']);
            $result     = controller_edit($id, $number, $nimetus, $kategooria);
            break;
        
        case 'kustuta':
            $id     = $_POST['id'];
            $result = controller_delete($id);
            break;
        
        case 'login':
            $kasutajanimi = $_POST['kasutajanimi'];
            $parool       = $_POST['parool'];
            $result       = controller_login($kasutajanimi, $parool);
            break;
        
        case 'reg':
            $kasutajanimi = $_POST['kasutajanimi'];
            $parool       = $_POST['parool'];
            $parool2      = $_POST['parool2'];
            $result       = controller_add_user($kasutajanimi, $parool, $parool2);
            break;
        
        case 'logout':
            $result = controller_logout();
            break;
    }
    
    if ($result) {
        header('Location: ' . $_SERVER['PHP_SELF']);
    } else {
        echo 'Viga!';
    }
    
    exit;
}

$view = empty($_GET['view']) ? 'register' : $_GET['view'];

switch ($view) {
    
    case 'register':
        check_login();
        $kategooria = empty($_GET['kategooria']) ? 0 : intval($_GET['kategooria']);
        require 'view_register.php';
        break;
    case 'login':
        require 'view_login.php';
        break;
    case 'reg':
        require 'view_reg.php';
        break;
    case 'help':
        require 'help.php';
        break;
    case 'edit':
        check_login();
        $dok = model_get($_GET['id']);
        if (!$dok) {
            echo 'Tundmatu ID';
            exit;
        }
        require 'view_edit.php';
        break;
    
    default:
        echo 'Viga!';
}

function check_login()
{
    if (!controller_user()) {
        header('Location: ' . $_SERVER['PHP_SELF'] . '?view=login');
        exit;
    }
}
