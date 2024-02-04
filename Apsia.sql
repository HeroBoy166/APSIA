CREATE TABLE usuarios (
	id_usuario MEDIUMINT UNSIGNED AUTO_INCREMENT,
	nome VARCHAR(50) NOT NULL,
	senha VARCHAR(50) NOT NULL,
	email VARCHAR(50) NOT NULL UNIQUE,
	privilegio ENUM('usuario', 'psicologo', 'admin') DEFAULT 'usuario',
		PRIMARY KEY (id_usuario)
);

CREATE TABLE grupos (
	id_grupo MEDIUMINT UNSIGNED AUTO_INCREMENT,
	nome VARCHAR(50) NOT NULL,
  		PRIMARY KEY (id_grupo)
);

CREATE TABLE mensagens (
	id_mensagem MEDIUMINT UNSIGNED AUTO_INCREMENT,
	conteudo TEXT NOT NULL,
  	horario DATETIME DEFAULT CURRENT_TIMESTAMP(), #'AAAA-MM-DD HH:MM'
	#status_mensagem ENUM('Pendente', 'Enviada', 'Visualizada') NOT NULL,
  		PRIMARY KEY (id_mensagem),
  
  	remetente_id MEDIUMINT UNSIGNED NOT NULL,
	destinatario_id MEDIUMINT UNSIGNED DEFAULT NULL,
	grupo_id MEDIUMINT UNSIGNED DEFAULT NULL,
		FOREIGN KEY (remetente_id) REFERENCES usuarios (id_usuario),
		FOREIGN KEY (destinatario_id) REFERENCES usuarios (id_usuario),
		FOREIGN KEY (grupo_id) REFERENCES grupos (id_grupo)
);