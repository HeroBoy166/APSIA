<?php
    include("../conexao.php");
    session_start();

    $id_remetente = $_SESSION['id_usuario'];

    $output = '';

    $sqlU = ($_SESSION['privilegio'] == "usuario") 
        ? "SELECT * FROM usuarios WHERE NOT id_usuario = $id_remetente AND privilegio = 'psicologo'"
        : "SELECT * FROM usuarios WHERE NOT id_usuario = $id_remetente AND privilegio != 'admin'";
        $consultaU = mysqli_query($mysqli, $sqlU);

    $sqlG = "SELECT * FROM grupos";
        $consultaG = mysqli_query($mysqli, $sqlG);


    if (mysqli_num_rows($consultaU) != 0){
        include("../dataU.php");
    }

    if (mysqli_num_rows($consultaG) != 0){
        include("../dataG.php");
    }
    
    if (mysqli_num_rows($consultaU) == 0 AND mysqli_num_rows($consultaG) == 0) {
        $output .= "Nenhum psicólogo ou grupo está disponível!";
    }

    echo $output;
?>