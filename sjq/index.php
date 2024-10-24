<?php
ini_set('session.gc_maxlifetime', 86400);
ini_set('session.cookie_lifetime', 0);
session_set_cookie_params(0);
session_start();

if (!isset( $_SESSION['last_access'])){
    $_SESSION['last_access'] = time();
    require_once __DIR__ . '/../includes/Thumbnail.php';
    new Thumbnail();
}else if(isset($_SESSION['last_access']) && $_SESSION['last_access'] + 86400 < time()){
    session_destroy();
    unset( $_SESSION );
}









