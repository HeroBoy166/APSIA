<?php
    while ($linha = mysqli_fetch_assoc($consultaG)){
        $id_grupo = $linha['id_grupo'];

        $sql2 = "SELECT * FROM mensagens WHERE grupo_id = $id_grupo ORDER BY horario DESC LIMIT 1";
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

        $output .= '<a href="ChatRoom.php?q='. decbin($id_grupo) .'">
                    <div class="content">
                    <img src="imagens/group-icon.png" alt="">
                    <div class="details">
                        <span>'. $linha['nome'] .'</span>
                        <p>'. $voce . $conteudo .'</p>
                    </div>
                    </div>
                    <div class="status-dot"><i class="fas fa-circle"></i></div>
                </a>';
    }
?>