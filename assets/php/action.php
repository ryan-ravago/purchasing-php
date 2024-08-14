<?php
session_start();

require_once 'query.php';

$query = new Query();
date_default_timezone_set('Asia/Manila');

if (isset($_POST['action'])) {
  if ($_POST['action'] == 'google-login') {
    echo json_encode(['message' => 'hi']);
  }
}