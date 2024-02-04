<?php
    include('../Chat/PHP/conexao.php');

    $id = $_POST['id'];

    $sql = "DELETE FROM mensagens WHERE destinatario_id=$id OR remetente_id=$id;";
        mysqli_query($mysqli, $sql);

    header('Location: ./index.php');
?>