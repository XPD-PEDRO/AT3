<?php
include("../conexao.php");

if (isset($_POST['acao']) && $_POST['acao'] == 'editar') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_tarefa = $_POST['data_tarefa'];
    $status = $_POST['status'];

    $sql = "UPDATE tarefas SET titulo='$titulo', 
    descricao='$descricao', 
    data_tarefa='$data_tarefa', 
    status='$status' 
    WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: listar.php?status=atualizado");
        exit;
    } else {
        header("Location: listar.php?status=erro");
        exit;
    }
    
}
?>