<?php
    include("PHP/conexao.php");
    session_start();
    
    if (!isset($_SESSION['id_usuario'])){
        header("Location: Login.php");
    }
?>

<?php include("header.php"); ?>
    <body>
        <div class="wrapper">
            <section class="users">
            <header>
                <div class="content">

                <?php
                    $sql = "SELECT * FROM usuarios WHERE id_usuario={$_SESSION['id_usuario']}";
                        $consulta = mysqli_query($mysqli, $sql);
                            $linha = mysqli_fetch_assoc($consulta);
                ?>

                <img src="imagens/profile-icon1.png" alt="">
                <div class="details">
                    <span><?php echo $linha['nome']?></span>
                    <p>On-line</p>
                </div>
                </div>
                <a href="PHP/Usuarios/deslogar.php" class="logout">Sair</a>
            </header>
            <div class="search">
                <span class="text">Procurar um psicólogo ou grupo</span>
                <input type="text" placeholder="Digite um nome para procurar...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">

            </div>
            </section>
        </div>

    <script>
        const searchBar = document.querySelector(".search input"),
        searchIcon = document.querySelector(".search button"),
        usersList = document.querySelector(".users-list");

        searchIcon.onclick = ()=>{
        searchBar.classList.toggle("show");
        searchIcon.classList.toggle("active");
        searchBar.focus();
        if(searchBar.classList.contains("active")){
            searchBar.value = "";
            searchBar.classList.remove("active");
        }
        }

        searchBar.onkeyup = ()=>{
        let termoPesquisa = searchBar.value;
        if(termoPesquisa != ""){
            searchBar.classList.add("active");
        }else{
            searchBar.classList.remove("active");
        }
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "PHP/Conversas/pesquisarConversas.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                let data = xhr.response;
                usersList.innerHTML = data;
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("termoPesquisa=" + termoPesquisa);
        }

        setInterval(() =>{
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "PHP/Conversas/visualizarConversas.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                let data = xhr.response;
                if(!searchBar.classList.contains("active")){
                    usersList.innerHTML = data;
                }
                }
            }
        }
        xhr.send();
        }, 500);
    </script>

    </body>
</html>
