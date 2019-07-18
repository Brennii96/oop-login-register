<?php
require_once 'core/init.php';

$user = DB::getInstance()->get('user', array('username', '=', 'brendan'));

if ($user->error()) {
    echo 'No user';
} else {
    echo 'Ok';
}