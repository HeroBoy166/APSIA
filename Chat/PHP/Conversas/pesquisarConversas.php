<?php
    session_start();
    include("../conexao.php");

    $id_remetente = $_SESSION['id_usuario'];
    $termoPesquisa = mysqli_real_escape_string($mysqli, $_POST['termoPesquisa']);
    $output = "";


    $sqlU = ($_SESSION['privilegio'] == "usuario") 
        ? "SELECT * FROM usuarios WHERE NOT id_usuario = $id_remetente AND (nome LIKE '%{$termoPesquisa}%' OR email LIKE '%{$termoPesquisa}%') AND privilegio = 'psicologo' "
        : "SELECT * FROM usuarios WHERE NOT id_usuario = $id_remetente AND (nome LIKE '%{$termoPesquisa}%' OR email LIKE '%{$termoPesquisa}%') AND privilegio != 'admin' ";
        $consultaU = mysqli_query($mysqli, $sqlU);

    $sqlG = "SELECT * FROM grupos WHERE nome LIKE '%{$termoPesquisa}%' ";
        $consultaG = mysqli_query($mysqli, $sqlG);


    if (mysqli_num_rows($consultaU) != 0){
        include("../dataU.php");
    }

    if (mysqli_num_rows($consultaG) != 0){
        include("../dataG.php");
    }
    
    if (mysqli_num_rows($consultaU) == 0 AND mysqli_num_rows($consultaG) == 0) {
        $output .= 'Nenhum psicólogo ou grupo encontrado com base na pesquisa';
    }

    echo $output;
?>