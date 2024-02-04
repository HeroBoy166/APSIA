<?php
    include('../Chat/PHP/conexao.php');

    $sql = "SET FOREIGN_KEY_CHECKS = 0; ";
    $sql .= "TRUNCATE mensagens; " . "TRUNCATE grupos; " . "TRUNCATE usuarios; ";
    $sql .= file_get_contents('../Dados.sql', true);
    $sql .= "SET FOREIGN_KEY_CHECKS = 1; ";
        mysqli_multi_query($mysqli, $sql);

    header('Location: ./index.php');
?>