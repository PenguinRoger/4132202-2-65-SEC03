<?php

$user = $_GET['user'];
echo "Pass:" . $_GET['pass'];

if($user == '1'){
    echo "hello";
}else
    echo $user;

echo $user == 1 ?"hello" :$user;
?>