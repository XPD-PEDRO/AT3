<?php
include("../conexao.php");

$id = $_GET['id'];

$sql = "DELETE FROM tarefas WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    header("Location: listar.php?status=excluido");
    exit;
} else {
    header("Location: listar.php?status=erro");
    exit;
}

?>