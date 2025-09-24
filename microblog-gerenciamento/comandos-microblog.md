## Criando Bando de Dados

``` SQL
-- Criar o banco de dados 

CREATE DATABASE microblog_amorim CHARACTER SET utf8mb4;
```

## Criando a tabela usuarios
``` SQL
-- Criar a tabela usuarios 

CREATE TABLE usuarios(
    id_usuario INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('admin','editor') NOT NULL
);
```

## Criando a tabela noticias
``` SQL
-- Criar a tabela noticias

CREATE TABLE noticias(
    id_noticias INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    data_publicacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    extensao_imagem VARCHAR(100) NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    resumo TEXT NOT NULL,
    texto_completo TEXT NOT NULL,
    FOREIGN KEY (id_usuarios) REFERENCES usuarios(id_usuarios)
);
```