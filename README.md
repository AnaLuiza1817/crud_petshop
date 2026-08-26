# 🐾 CRUD PetShop — AUmigos

Ana Luiza Breia / Estudante Desenvolvimento de Sistema / Escola Sesi de Sistema  

Sistema de cadastro e gerenciamento de clientes e seus animais de estimação desenvolvido para a **AUmigos PetShop**. O projeto tem como objetivo organizar as informações dos clientes e dos pets atendidos pela empresa, facilitando o cadastro e a visualização dos dados.

## Sobre o projeto

A AUmigos é uma pet shop que oferece serviços como banho, tosa, consultas e outros cuidados para animais de estimação.

Anteriormente, os dados dos clientes e de seus animais eram registrados de maneira desorganizada, dificultando o controle dos pets atendidos.

Para solucionar esse problema, foi desenvolvido este sistema CRUD, permitindo cadastrar clientes e seus respectivos pets em um banco de dados e visualizar essas informações em uma tela de gerenciamento.

## Funcionalidades

* Cadastro de clientes;
* Cadastro de pets vinculados a um cliente;
* Registro do nome, telefone e e-mail do responsável;
* Registro do nome, espécie, raça, idade e peso do pet;
* Armazenamento das informações no banco de dados;
* Visualização dos clientes cadastrados;
* Visualização dos pets relacionados a cada cliente;
* Tela de gerenciamento dos cadastros;
* Integração entre PHP e banco de dados;
* Validação dos dados enviados pelo formulário.

## Interface

### Tela de cadastro

A tela permite cadastrar o responsável pelo animal e, em seguida, informar os dados do pet.

Os campos disponíveis são:

**Dados do responsável**

* Nome;
* Telefone;
* E-mail.

**Dados do pet**

* Nome;
* Espécie;
* Raça;
* Idade;
* Peso.

### Tela de gerenciamento

A tela de gerenciamento apresenta os clientes cadastrados e seus respectivos pets, permitindo consultar de forma organizada:

* Cliente;
* Telefone;
* E-mail;
* Pets cadastrados.

## Tecnologias utilizadas

O projeto foi desenvolvido utilizando:

* **HTML5** — estrutura das páginas;
* **CSS3** — estilização e layout;
* **PHP** — processamento do cadastro e comunicação com o banco;
* **MySQL** — armazenamento dos dados;
* **Apache** — servidor local para execução do PHP;
* **XAMPP** — ambiente de desenvolvimento local.

## Estrutura do projeto

```text
CRUD_PETSHOP/
│
├── Database/
│   └── db.sql
│
├── infra/
│   └── conexao.php
│
├── js/
│   ├── cadastrar.php
│   └── gerencie.php
│
└── Print/
    ├── cadastrados.png
    └── mostrando_erro.png
```

### Descrição das pastas

**Database/**
Contém o arquivo SQL responsável pela criação e configuração do banco de dados.

**infra/**
Contém os arquivos relacionados à infraestrutura do sistema, como a conexão com o banco de dados.

**js/**
Contém os arquivos PHP responsáveis pelo funcionamento das telas de cadastro e gerenciamento.

**Print/**
Contém imagens utilizadas para registrar e demonstrar o funcionamento do sistema.

## 🗄️ Banco de dados

O sistema utiliza um banco de dados para armazenar as informações dos responsáveis e de seus pets.

A estrutura foi pensada para relacionar o cliente ao animal cadastrado, permitindo que um responsável tenha seus respectivos pets associados.

O arquivo responsável pela configuração do banco é:

```text
Database/db.sql
```

## 🚀 Como executar o projeto

### 1. Instale o XAMPP

Baixe e instale o [XAMPP](https://www.apachefriends.org/).

Depois, abra o painel de controle e inicie:

```text
Apache
MySQL
```

### 2. Coloque o projeto no servidor local

Copie a pasta do projeto para:

```text
C:\xampp\htdocs\
```

Por exemplo:

```text
C:\xampp\htdocs\CRUD_PETSHOP\
```

### 3. Crie o banco de dados

Abra o **phpMyAdmin** pelo endereço:

```text
http://localhost/phpmyadmin
```

Crie o banco de dados utilizado pelo projeto ou importe diretamente o arquivo:

```text
Database/db.sql
```

### 4. Configure a conexão

Verifique o arquivo:

```text
infra/conexao.php
```

e confira se as informações de conexão correspondem ao seu ambiente local.

Exemplo:

```php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "petshop";
```

> Os valores devem ser ajustados de acordo com a configuração do seu MySQL.

### 5. Execute o sistema

Com o Apache e o MySQL funcionando, acesse pelo navegador:

```text
http://localhost/CRUD_PETSHOP/
```

A partir daí, é possível acessar a tela de cadastro e realizar o gerenciamento dos clientes e pets.

## Funcionamento do CRUD

O sistema segue o conceito de **CRUD**, que representa as quatro operações básicas de manipulação de dados:

| Operação       | Função                          |
| -------------- | ------------------------------- |
| **C — Create** | Cadastrar novos clientes e pets |
| **R — Read**   | Visualizar os dados cadastrados |
| **U — Update** | Atualizar dados existentes      |
| **D — Delete** | Excluir dados existentes        |

Atualmente, as principais telas apresentadas no projeto são a de **cadastro** e a de **gerenciamento dos registros**.

## Tratamento de erros

O sistema possui uma mensagem de erro exibida quando ocorre algum problema durante o cadastro:

> "Erro ao cadastrar. Verifique os dados e tente novamente."

Isso permite informar ao usuário que os dados não foram registrados corretamente e que é necessário verificar as informações preenchidas.

## Objetivo acadêmico

Este projeto foi desenvolvido como atividade prática para aplicar conhecimentos de:

* Desenvolvimento Web;
* PHP;
* Banco de Dados;
* SQL;
* CRUD;
* Formulários HTML;
* Conexão entre aplicação e banco de dados;
* Organização de projetos.

## Autoria

Projeto desenvolvido como atividade acadêmica do curso técnico em **Desenvolvimento de Sistemas**.

**AUmigos PetShop — Sistema de Cadastro e Gerenciamento de Clientes e Pets.**

---

**AUmigos PetShop**
*Organizando os dados para cuidar melhor dos nossos melhores amigos.*
