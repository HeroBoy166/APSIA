<?php
    include("../conexao.php");
    session_start();

    $id_remetente = $_SESSION['id_usuario'];
    $output = "";

    if (isset($_POST['id_destinatario'])) {
        $id_destinatario = mysqli_real_escape_string($mysqli, $_POST['id_destinatario']);

        $sql = "SELECT * FROM mensagens LEFT JOIN usuarios ON usuarios.id_usuario = mensagens.remetente_id
                WHERE (remetente_id = $id_remetente AND destinatario_id = $id_destinatario)
                OR (remetente_id = $id_destinatario AND destinatario_id = $id_remetente) ORDER BY mensagens.horario";
            
        $consulta = mysqli_query($mysqli, $sql);

        if (mysqli_num_rows($consulta) > 0){
            while ($linha = mysqli_fetch_assoc($consulta)){

                if ($linha['remetente_id'] === $id_remetente){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $linha['conteudo'] .'</p>
                                </div>
                                </div>';

                } else {
                    $output .= '<div class="chat incoming">

                                <div class="details">
                                    <p>'. $linha['conteudo'] .'</p>
                                </div>
                                </div>';
                }
            }

        } else {
            $output .= '<div class="text">Nenhuma mensagem disponível. Sua futura conversa aparecerá aqui.</div>';
        }


    } else if (isset($_POST['id_grupo'])) {
        $id_grupo = mysqli_real_escape_string($mysqli, $_POST['id_grupo']);
        
        $sql = "SELECT mensagens.*, usuarios.nome FROM mensagens 
                LEFT JOIN usuarios ON mensagens.remetente_id = usuarios.id_usuario
                WHERE mensagens.grupo_id = $id_grupo ORDER by mensagens.horario;";

        $consulta = mysqli_query($mysqli, $sql);

        if (mysqli_num_rows($consulta) > 0){
            while ($linha = mysqli_fetch_assoc($consulta)){

                if ($linha['remetente_id'] === $id_remetente){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $linha['conteudo'] .'</p>
                                </div>
                                </div>';
                } else {
                    if ((isset($ultimo_nome)) AND ($ultimo_nome == $linha['nome'])) {
                        $output .= '<div class="chat incoming">
                                    <div class="details">
                                    <p>'. $linha['conteudo'] .'</p>
                                    </div>
                                    </div>';

                    } else {
                        $output .= '<div class="chat incoming">
                                    <div class="details">
                                    <p><b>'. $linha['nome'] .': </b>'. $linha['conteudo'] .'</p>
                                    </div>
                                    </div>';
                    }

                }
                $ultimo_nome = $linha['nome'];
            }

        } else {
            $output .= '<div class="text">Nenhuma mensagem disponível. As futuras mensagens desse grupo aparecerão aqui.</div>';
        }
    }

    

    echo $output;
?>