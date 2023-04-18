<?php

use App\Models\UserModel;

function escape_input($i = '') {
	return htmlspecialchars(strip_tags($i));
}

function user($i = 'id') {
	$userModel = new UserModel();
	$user = $userModel->find(session()->user);
	return $user[$i];
}