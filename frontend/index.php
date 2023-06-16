<?php

require('../backend/autoload.php');


use backend\model\User;

$user = new User();

// get all users
$users = $user->all();

echo '<pre>';
print_r($users);
echo '</pre>';