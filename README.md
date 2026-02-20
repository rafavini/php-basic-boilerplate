# PHP Basic Boilerplate - Didactic MVC

Este é um projeto didático que implementa uma estrutura básica de arquitetura MVC (Model-View-Controller) em PHP puro, focado em organização, segurança e facilidade de deploy.

## 📁 Estrutura de Pastas

*   **`app/`**: Contém o núcleo da aplicação.
    *   **`Controllers/`**: Lógica de negócio e controle de fluxo.
    *   **`Core/`**: Classes base do sistema (Roteador, Banco de Dados, Controller base).
    *   **`Models/`**: Classes que representam as entidades de dados e interagem com o banco.
    *   **`Routes/`**: Definição das rotas do sistema (`routes.php`).
    *   **`Views/`**: Templates HTML/PHP renderizados para o usuário.
*   **`config/`**: Arquivos de configuração centralizada (`app.php`).
*   **`database/`**: Scripts SQL, migrations ou dumps do banco de dados.
*   **`public/`**: Arquivos estáticos acessíveis pelo navegador (CSS, JS, Imagens).
*   **`index.php`**: O **ponto de entrada único** da aplicação (Front Controller).
*   **`.htaccess`**: Configurações do Apache para URLs amigáveis e segurança.

## 🔄 Fluxo da Aplicação

O sistema utiliza o padrão **Front Controller**, onde todas as requisições passam por um único arquivo:

1.  **Requisição**: O usuário acessa uma URL (ex: `/dashboard`).
2.  **Roteamento (`index.php`)**:
    *   Carrega as configurações globais.
    *   Define a constante `BASE_URL`.
    *   Registra o autoloader para carregar classes automaticamente.
    *   Instancia o `Router` e carrega o arquivo `app/Routes/routes.php`.
    *   Chama o método `dispatch()` do Roteador.
3.  **Despacho (`Core\Router`)**:
    *   Compara a URL atual com as rotas registradas.
    *   Instancia o Controller correspondente e executa o método definido.
4.  **Lógica (`Controller`)**:
    *   O Controller pode solicitar dados a um `Model`.
    *   O Controller decide qual `View` exibir, passando os dados necessários.
5.  **Resposta**: A View é renderizada e enviada de volta ao navegador do usuário.

## ⚙️ Configuração Centralizada

Todas as configurações principais do sistema estão em `config/app.php`:

```php
return [
    'app_name' => 'Seu Projeto',
    'base_folder' => '/nome-da-pasta/', // Nome da pasta no htdocs (importante para o roteamento)
    'db' => [
        'host' => 'localhost',
        'dbname' => 'nome_do_banco',
        'user' => 'usuario',
        'pass' => 'senha'
    ]
];
```

## 🔒 Segurança

*   **Acesso Restrito**: Pastas como `app/`, `config/` e `database/` possuem arquivos `.htaccess` que bloqueiam o acesso direto via navegador (`Deny from all`).
*   **URLs Amigáveis**: O roteamento oculta o caminho físico dos arquivos, expondo apenas rotas limpas.
*   **Variáveis de Ambiente**: O uso de `BASE_URL` (PHP) e `window.BASE_URL` (JS) garante que o sistema funcione corretamente em qualquer subdiretório sem a necessidade de alterar caminhos em múltiplos arquivos.

## 🚀 Como usar

1.  Clone o projeto para seu servidor local (ex: XAMPP/htdocs).
2.  Importe o banco de dados que está na pasta `database/`.
3.  Ajuste as credenciais e o `base_folder` em `config/app.php`.
4.  Acesse via `http://localhost/seu-projeto/`.
