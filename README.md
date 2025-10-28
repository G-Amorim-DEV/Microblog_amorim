# Microblog com POO - Fullstack 2025

Tecnologias utilizadas: 

- HTML5/CSS3/Bootstrap 5
- PHP com Programação Orientada a Objetos
- Banco de dados MySQL

## Requisitos para executar o projeto

- Importar o arquivo de backup do banco de dados através do phpMyAdmin
- Com o XAMPP startado, abrir no navegador: `localhost/microblog`

---

## Sobre as áreas do site

### PÚBLICA

Páginas que **não precisam de autenticação** para o acesso.

São as páginas na raíz do projeto: 

- index
- login
- noticia
- resultados

### ADMINISTRATIVA

Páginas que **precisam de autenticação** para o acesso, sendo que algumas delas tem privilégios de acesso diferenciado.

São as páginas contidas na pasta **admin** do projeto: 

- index
- meu-perfil
- usuarios
- usuario-insere
- usuario-atualiza
- usuario-exclui
- noticias
- noticia-insere
- noticia-atualiza
- noticia-exclui
- nao-autorizado

#### Privilégios de acesso

- Usuários do tipo **admin**, podem acessar e modificar **TUDO**.
- Usuários do tipo **editor**, podem acessar e modificar **somente** seus próprios dados e suas próprias notícias. 

Ou seja, **não podem** por exemplo, administrar outros usuários e categorias.