<?php
include("../conexao.php");

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$data_tarefa = $_POST['data_tarefa'];
$status = $_POST['status'];

$sql = "INSERT INTO tarefas (titulo, descricao, data_tarefa, status) 
        VALUES ('$titulo', '$descricao', '$data_tarefa', '$status')";

if (mysqli_query($conn, $sql)) {
    header("Location: listar.php?status=sucesso");
    exit;
} else {
    header("Location: listar.php?status=erro");
    exit;   
}

?>