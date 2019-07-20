<?php
require_once 'core/init.php';

$user = DB::getInstance()->get('users', array('username', '=', 'brendan'));

if ($user->error()) {
    echo 'No user';
} else {
    foreach ($user->results() as $user){
        echo $user->username;
    }
}