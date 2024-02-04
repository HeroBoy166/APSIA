<?php 
    include("../conexao.php");
    session_start();

    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $senha = mysqli_real_escape_string($mysqli, $_POST['senha']);

    $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
        $consulta = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($consulta) == 0) {
        $_SESSION['erro'] = "Conta não encontrada!";
        header('Location: ../../Login.php');

    } else {
        $linha = mysqli_fetch_array($consulta);  
            $_SESSION['id_usuario'] = $linha['id_usuario'];
            $_SESSION['privilegio'] = $linha['privilegio'];

        if ($_SESSION['privilegio'] == "admin") {
            header('Location: ../../../Admin/index.php');
            
        } else {
            header('Location: ../../Conversas.php');
        }
    }
?>