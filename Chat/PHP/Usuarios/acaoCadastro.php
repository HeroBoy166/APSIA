<?php
    include("../conexao.php");
    session_start();

    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $senha = mysqli_real_escape_string($mysqli, $_POST['senha']);

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
        $consulta = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($consulta) != 0) {
        $_SESSION['erro'] = "E-mail já cadastrado!";
        header('Location: ../../Cadastro.php');

    } else {
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
            mysqli_query($mysqli, $sql);

        $_SESSION['email_cadastrado'] = $email;
        header('Location: ../../Login.php');
    }
?>