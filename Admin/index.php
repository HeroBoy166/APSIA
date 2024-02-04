<?php
    session_start();
    
    if (!isset($_SESSION['id_usuario']) OR $_SESSION['privilegio'] != "admin"){
        header("Location: ../Chat/PHP/Usuarios/deslogar.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/x-icon" href="../imagens/icone.png" />
    <title>APSIA</title>
  </head>
  
  <body>
    <h1>Painel de Admin</h1>
    <p>
      <form method="POST" action="deletarConta.php">
        Deletar/Banir uma Conta 
        <input type="number" name="id" placeholder="id da conta" required/>
        <input type="submit" value="Realizar"/>
      </form>
    <p>
    <p>
      <form method="POST" action="apagarMensagens.php">
        Apagar Mensagens de um Usuário
        <input type="number" name="id" placeholder="id da conta" required/>
        <input type="submit" value="Realizar"/>
      </form>
    <p>
    <p>
      <form method="POST" action="apagarMensagens2.php">
        Apagar Mensagens de um Grupo
        <input type="number" name="id" placeholder="id do grupo" required/>
        <input type="submit" value="Realizar"/>
      </form>
    <p>
    <p>
      <form method="POST" action="resetarDB.php">
        Resetar DataBase
        <input type="submit" value="Realizar"/>
      </form>
    <p>
    <p>
      <form method="POST" action="../Chat/PHP/Usuarios/deslogar.php">
        Deslogar
        <input type="submit" value="Sair"/>
      </form>
    <p>
  </body>
</html>