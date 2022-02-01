### This Dev Social Media

<p>Fiz este projeto com a ajuda do curso de PHP da b7web, porém novamente fiz vária alterações no layout e algumas otimizações básicas em algumas querys sql e algumas funcionalidades do projeto.</p>

<img src=""/>

### Features

- [x] Sistema de autenticação
- [x] Cadastro de novos usuários
- [x] Lista de posts e fotos dos seus amigos
- [x] Adicionar novos posts/fotos
- [x] Excluir posts
- [x] Curtir/comentar posts/fotos de amigos
- [x] Sistema de busca
- [x] Página de amigos
- [x] Página de fotos
- [x] Alteração dos dados do perfil do usuário logado avatar,cover e outras informações
- [x] Seguir e deixar de seguir

### Pré requisitos
Antes de iniciar você precisa ter o [Xampp](https://www.apachefriends.org/pt_br/index.html) instalado na sua máquina, essa ferramenta traz junto de si o PHP e o Mysql. É bom também ter um editor de código como [VSCode](https://code.visualstudio.com/).

Você pode clonar este repositório ou baixar o zip.

Ao descompactar, é necessário rodar o **composer** para instalar as dependências e gerar o *autoload*.

Vá até a pasta do projeto, pelo *prompt/terminal* e execute:
> composer install

### Configurações do projeto

Todos os arquivos de **configuração** do projeto estão dentro da pasta *src*.

As configurações de Banco de Dados e URL estão no arquivo *src/Config.php*

É importante configurar corretamente a constante *BASE_DIR* e também as constantes do Banco de dados *DB_DATABASE*:
> const BASE_DIR = '/**PastaDoProjeto**/public';

### Tecnologias

Neste projeto foram usadas as seguintes tecnologias

- [PHP](https://www.php.net/)
- [Mysql](https://www.mysql.com/)
- [HYDRAHON](https://clancats.io/hydrahon/master/)

<hr/>
Criado com dedicação por <a href="https://github.com/d8web/" target="_blank">Daniel</a>.