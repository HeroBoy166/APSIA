<?php
    while ($linha = mysqli_fetch_assoc($consultaU)){
        $id_destinatario = $linha['id_usuario'];

        $sql2 = "SELECT * FROM mensagens WHERE (destinatario_id = $id_destinatario OR remetente_id = $id_destinatario) AND 
        (remetente_id = $id_remetente OR destinatario_id = $id_remetente) ORDER BY horario DESC LIMIT 1";

            $consulta2 = mysqli_query($mysqli, $sql2);
                $linha2 = mysqli_fetch_assoc($consulta2);

        $resultado = (mysqli_num_rows($consulta2) > 0) ? $linha2['conteudo'] : "Nenhuma mensagem disponível";
        $conteudo = (strlen($resultado) > 28) ? substr($resultado, 0, 28) . '...' : $resultado;

        if (isset($linha2['remetente_id'])){
            $voce = ($id_remetente == $linha2['remetente_id']) ? "Você: " : "";

        } else {
            $voce = "";
        }

        //$offline = ($linha['status'] == "Offline") ? "offline" : "";
        //$esconder = ($id_remetente == $id_destinatario) ? "hide" : "";

        $output .= '<a href="Chat.php?q='. decbin($id_destinatario) .'">
                    <div class="content">
                    <img src="imagens/profile-icon1.png" alt="">
                    <div class="details">
                        <span>'. $linha['nome'] .'</span>
                        <p>'. $voce . $conteudo .'</p>
                    </div>
                    </div>
                    <div class="status-dot"><i class="fas fa-circle"></i></div>
                </a>';
    }
?>