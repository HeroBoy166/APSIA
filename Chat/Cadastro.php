<?php 
    session_start();
    include("header.php"); 

?>
    <body>

        <div class="wrapper">
            <section class="form signup">
                <header>Cadastro</header>
                <form method="POST" action="PHP/Usuarios/acaoCadastro.php" autocomplete="off">
                    
                    <?php 
                        if (!empty($_SESSION['erro'])) {
                            echo "<div class='error-text'>" . $_SESSION['erro'] . "</div>";
                            $_SESSION['erro']="";
                        }
                    ?>

                    <div class="field input">
                        <label>Nome</label>
                        <input type="text" name="nome" placeholder="Digite seu nome" required>
                    </div>

                    <div class="field input">
                        <label>E-mail</label>
                        <input type="email" name="email" placeholder="Digite seu email" required>
                    </div>

                    <div class="field input">
                        <label>Senha</label>
                        <input type="password" name="senha" placeholder="Digite sua senha" required>
                        <i class="fas fa-eye"></i>
                    </div>
                    
                    <div class="field button">
                        <input type="submit" name="submit" value="Cadastrar-se">
                    </div>
                </form>

                <div class="link">Já possui uma conta? <a href="Login.php">Logue</a> 
                <p><a href="../views/Home.html">Voltar para a Home</a></div>
            </section>
        </div>

        <script src="javascript/pass-show-hide.js"></script>

    </body>
</html>
