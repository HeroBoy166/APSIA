<?php
    include("../conexao.php");
    session_start();
    
    $id_remetente = $_SESSION['id_usuario'];
    $mensagem = mysqli_real_escape_string($mysqli, $_POST['mensagem']);
    //$agora = date('Y-m-d h:i');

    if (!empty($mensagem)){
        if (isset($_POST['id_destinatario'])) {
            $id_destinatario = mysqli_real_escape_string($mysqli, $_POST['id_destinatario']);
            $sql = "INSERT INTO mensagens (conteudo, remetente_id, destinatario_id) VALUES ('$mensagem', $id_remetente, $id_destinatario)";

        } else if (isset($_POST['id_grupo'])) {
            $id_grupo = mysqli_real_escape_string($mysqli, $_POST['id_grupo']);
            $sql = "INSERT INTO mensagens (conteudo, remetente_id, grupo_id) VALUES ('$mensagem', $id_remetente, $id_grupo)";
        }
        
        mysqli_query($mysqli, $sql);    
    }
?>