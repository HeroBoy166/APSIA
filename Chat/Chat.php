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
            <section class="chat-area">
            <header>

                <?php 
                    $id_destinatario = mysqli_real_escape_string($mysqli, bindec($_GET['q']));
                    
                    $sql = "SELECT * FROM usuarios WHERE id_usuario = $id_destinatario";
                        $consulta = mysqli_query($mysqli, $sql);;
                            $linha = mysqli_fetch_assoc($consulta);
                ?>

                <a href="Conversas.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="imagens/profile-icon1.png" alt="">
                <div class="details">
                <span><?php echo $linha['nome'] ?></span>
                <p><?php echo $linha['email']; ?></p>
                </div>
            </header>

            <div class="chat-box">

            </div>

            <form action="#" class="typing-area">
                <input type="text" class="id_destinatario" name="id_destinatario" value="<?php echo $id_destinatario; ?>" hidden>
                <input type="text" class="input-field" name="mensagem"  placeholder="Digite sua mensagem aqui..." autocomplete="off">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
            </section>
        </div>

    <script>
        const form = document.querySelector(".typing-area"),
        id_destinatario = form.querySelector(".id_destinatario").value,
        inputField = form.querySelector(".input-field"),
        sendBtn = form.querySelector("button"),
        chatBox = document.querySelector(".chat-box");

        form.onsubmit = (e)=>{
            e.preventDefault();
        }

        inputField.focus();
        inputField.onkeyup = ()=>{
            if(inputField.value != ""){
                sendBtn.classList.add("active");
            }else{
                sendBtn.classList.remove("active");
            }
        }

        sendBtn.onclick = ()=>{
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "PHP/Mensagens/enviarMensagem.php", true);
            xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    inputField.value = "";
                    scrollToBottom();
                }
            }
            }
            let formData = new FormData(form);
            xhr.send(formData);
        }
        chatBox.onmouseenter = ()=>{
            chatBox.classList.add("active");
        }

        chatBox.onmouseleave = ()=>{
            chatBox.classList.remove("active");
        }

        setInterval(() =>{
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "PHP/Mensagens/visualizarMensagens.php", true);
            xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    chatBox.innerHTML = data;
                    if(!chatBox.classList.contains("active")){
                        scrollToBottom();
                    }
                }
            }
            }
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("id_destinatario="+id_destinatario);
        }, 500);

        function scrollToBottom(){
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    </script>

    </body>
</html>