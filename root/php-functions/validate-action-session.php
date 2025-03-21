<?php

session_start();

if(!isset($_SESSION['username'])){
    exit(json_encode(['success' => false, 'message' => 'Your session has ended, please login again.']));
}
