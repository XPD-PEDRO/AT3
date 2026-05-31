Tech Solutions - Sistema de Gestão Empresarial

Objetivo do Sistema
O Tech Solutions é um sistema web desenvolvido como projeto acadêmico para gerenciar as rotinas internas de uma empresa fictícia. O projeto conta com autenticação de sessão protegida e dois módulos principais: 
1. Gerenciamento de Usuários: CRUD para controle de acesso ao sistema.
2. Gerenciamento de Tarefas: CRUD para organizar e acompanhar demandas diárias, com status de andamento.

Tecnologias Utilizadas
* Back-end: PHP Nativo (estruturas de repetição, condicionais, variáveis globais $_POST/$_GET e controle de sessão session_start()).
* Banco de Dados: MySQL (utilizando a extensão mysqli).
* Front-end: HTML5, CSS3, e TailwindCSS (para o design responsivo e estilização dos componentes).

Estrutura do Projeto
CRUD_TAREFAS/
└── Crud-Login/
    ├── conexao.php
    ├── login.php
    ├── validar.php
    ├── logout.php
    ├── dashboard.php
    ├── cadastrar.php
    ├── atualizar.php
    ├── deletar.php
    ├── README.md
    └── Tarefas/
        ├── listar.php
        ├── cadastrar.php
        ├── editar.php
        └── excluir.php

Passo a passo para Instalação e Configuração

1. Configurar o Banco de Dados
1. Abra o painel do XAMPP e inicie os módulos Apache e MySQL.
2. Acesse o phpMyAdmin pelo navegador: http://localhost/phpmyadmin/
3. Crie um novo banco de dados chamado sistema_login.
4. Vá na aba SQL do banco recém-criado e execute o script abaixo para criar as tabelas e o usuário administrador padrão:

```sql
-- Criar tabela de Usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL
);

-- Criar tabela de Tarefas
CREATE TABLE tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT,
    data_tarefa DATE NOT NULL,
    status VARCHAR(50) NOT NULL
);

-- Inserir um usuário administrador para o primeiro acesso
INSERT INTO usuarios (nome, email, senha) VALUES ('Admin', 'admin@techsolutions.com', '123456');

2. Executar o Projeto no XAMPP
Clone este repositório ou extraia a pasta do projeto.

Mova a pasta inteira para dentro do diretório htdocs do seu XAMPP (Geralmente em C:\xampp\htdocs).

Certifique-se de que a estrutura final no seu computador ficou como C:\xampp\htdocs\CRUD_TAREFAS\Crud-Login.

Como Acessar o Sistema
Abra o seu navegador e acesse a URL da tela de login:
http://localhost/CRUD_TAREFAS/Crud-Login/login.php

Para entrar, utilize as credenciais padrão do administrador:

E-mail: admin@techsolutions.com

Senha: 123456

Como Testar as Funcionalidades
Autenticação: Tente acessar o link do dashboard.php sem estar logado; o sistema deve barrar e redirecionar para o login. Em seguida, faça o login com as credenciais acima.

Usuários: No painel principal, clique em "Novo Usuário", preencha os dados e salve. Em seguida, teste editar o nome desse usuário e, por fim, excluí-lo usando os botões de ação na tabela.

Tarefas: Utilize o menu lateral para navegar até "Tarefas". Clique em "Nova Tarefa", preencha o Título, Descrição, Data e selecione um Status (Pendente, Em andamento ou Concluído). Use a barra de pesquisa rápida digitando parte do título para testar o filtro.

Logout: Clique em "Sair" no menu lateral inferior para encerrar a sessão de forma segura.

