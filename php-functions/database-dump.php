<?php

session_start();

require '../Class/DatabaseBackup.php';

$db = new DatabaseBackup;

$db->doBackup();