<?php
require 'db.php';
require 'functions.php';

$id = $_GET['id'] ?? null;
if (!$id) redirectTo("read.php");

$stmt = $pdo->prepare("DELETE FROM transactions WHERE id = :id");
$stmt->execute([':id' => $id]);

redirectTo("read.php");
?>