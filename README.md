# 🐾 CRUD PetShop — AUmigos

**Ana Luiza Breia**
**Estudante de Desenvolvimento de Sistemas**
**Escola SESI de Referência**

Sistema de cadastro e gerenciamento de clientes, pets e atendimentos desenvolvido para a **AUmigos PetShop**. O projeto tem como objetivo organizar as informações dos clientes e de seus animais de estimação, facilitando o cadastro, a consulta e o gerenciamento dos dados.

## Sobre o projeto

A **AUmigos PetShop** é uma empresa voltada para o cuidado e bem-estar de animais de estimação, oferecendo serviços como banho, tosa, consultas e outros atendimentos. Anteriormente, os dados dos clientes e de seus animais eram registrados de maneira desorganizada, dificultando o controle das informações e dos atendimentos realizados. Para solucionar esse problema, foi desenvolvido este sistema CRUD, permitindo cadastrar clientes e seus respectivos pets em um banco de dados, além de consultar e gerenciar essas informações por meio de uma interface web.

## Funcionalidades

* Cadastro de clientes;
* Cadastro de pets vinculados a um cliente;
* Registro do nome, telefone e e-mail do responsável;
* Registro do nome, espécie, raça, idade e peso do pet;
* Armazenamento das informações no banco de dados;
* Visualização dos clientes cadastrados;
* Visualização dos pets relacionados a cada cliente;
* Gerenciamento dos cadastros;
* Registro e visualização de atendimentos;
* Integração entre PHP e banco de dados;
* Validação dos dados enviados pelos formulários;
* Exibição de mensagens de erro quando ocorre algum problema no cadastro.

## Interface

### Tela de cadastro

A tela de cadastro permite registrar as informações do responsável pelo animal e, em seguida, os dados do pet.

#### Dados do responsável

* Nome;
* Telefone;
* E-mail.

#### Dados do pet

* Nome;
* Espécie;
* Raça;
* Idade;
* Peso.

### Tela de gerenciamento

A tela de gerenciamento apresenta os registros cadastrados de forma organizada, permitindo consultar informações dos clientes e de seus respectivos pets.

Entre as informações apresentadas estão:

* Cliente;
* Telefone;
* E-mail;
* Pets cadastrados.

### Tela de atendimento

O sistema também possui uma tela específica para o gerenciamento dos atendimentos realizados pela pet shop. Essa funcionalidade permite organizar as informações relacionadas aos serviços prestados aos animais, facilitando o controle dos atendimentos.

## Tecnologias utilizadas

O projeto foi desenvolvido utilizando:

* **HTML5** — estrutura das páginas;
* **CSS3** — estilização e organização da interface;
* **PHP** — processamento dos formulários e comunicação com o banco de dados;
* **MySQL** — armazenamento das informações;
* **Apache** — servidor local utilizado para execução do PHP;
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
│   ├── atendimento.php
│   ├── cadastrar.php
│   └── gerencie.php
│
└── Print/
    ├── area do gerenciamento.png
    ├── atendimentos.png
    └── mostrando_erro.png
```

### Descrição das pastas

**`Database/`**

Contém o arquivo SQL responsável pela criação e configuração do banco de dados utilizado pelo sistema.

**`infra/`**

Contém os arquivos relacionados à infraestrutura do sistema, principalmente a conexão com o banco de dados.

**`js/`**

Contém os arquivos PHP responsáveis pelo funcionamento das principais funcionalidades do sistema:

* `atendimento.php` — gerenciamento dos atendimentos;
* `cadastrar.php` — cadastro dos clientes e pets;
* `gerencie.php` — gerenciamento e visualização dos registros.

**`Print/`**

Contém imagens utilizadas para demonstrar e registrar o funcionamento do sistema:

* `area do gerenciamento.png` — demonstração da área de gerenciamento;
* `atendimentos.png` — demonstração da área de atendimentos;
* `mostrando_erro.png` — demonstração do tratamento de erros.

## 🗄️ Banco de dados

O sistema utiliza um banco de dados MySQL para armazenar as informações dos responsáveis, pets e demais registros utilizados pela aplicação.

A estrutura foi desenvolvida para relacionar os clientes aos seus respectivos animais, permitindo organizar os dados de maneira mais eficiente.

O arquivo responsável pela configuração do banco de dados é:

```text
Database/db.sql
```

##  Como executar o projeto

### 1. Instale o XAMPP

Baixe e instale o **XAMPP**.

Depois, abra o painel de controle do XAMPP e inicie os serviços:

```text
Apache
MySQL
```

### 2. Coloque o projeto no servidor local

Copie a pasta do projeto para o diretório:

```text
C:\xampp\htdocs\
```

Por exemplo:

```text
C:\xampp\htdocs\CRUD_PETSHOP\
```

### 3. Crie o banco de dados

Abra o **phpMyAdmin** pelo navegador:

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

e confira se as informações de conexão correspondem à configuração do seu ambiente local.

Um exemplo de configuração é:

```php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "petshop";
```

> Os valores devem ser ajustados de acordo com a configuração do MySQL no ambiente utilizado.

### 5. Execute o sistema

Com o **Apache** e o **MySQL** em funcionamento, acesse o projeto pelo navegador:

```text
http://localhost/CRUD_PETSHOP/
```

A partir daí, será possível acessar as funcionalidades de cadastro, gerenciamento e atendimento.

## Funcionamento do CRUD

O sistema segue o conceito de **CRUD**, que representa as quatro operações básicas de manipulação de dados:

| Operação       | Função                                       |
| -------------- | -------------------------------------------- |
| **C — Create** | Cadastrar novos clientes, pets e informações |
| **R — Read**   | Visualizar os dados cadastrados              |
| **U — Update** | Atualizar dados existentes                   |
| **D — Delete** | Excluir dados existentes                     |

A aplicação utiliza essas operações como base para o gerenciamento das informações armazenadas no banco de dados.

## Tratamento de erros

O sistema possui mensagens de erro para informar o usuário quando ocorre algum problema durante o cadastro ou processamento das informações.

Um exemplo apresentado na interface é:

> **"Erro ao cadastrar. Verifique os dados e tente novamente."**

Esse mecanismo ajuda o usuário a identificar que as informações não foram registradas corretamente e que os dados preenchidos precisam ser verificados.

## 🎓 Objetivo acadêmico

Este projeto foi desenvolvido como atividade prática do curso técnico em **Desenvolvimento de Sistemas**, com o objetivo de aplicar conhecimentos relacionados a:

* Desenvolvimento Web;
* HTML e CSS;
* PHP;
* Banco de Dados;
* SQL;
* CRUD;
* Formulários;
* Validação de dados;
* Conexão entre aplicação e banco de dados;
* Organização de projetos.

A atividade também busca demonstrar, na prática, como uma aplicação web pode ser integrada a um banco de dados para solucionar uma necessidade real de organização e gerenciamento de informações.

## Autoria

Projeto desenvolvido por **Ana Luiza Breia** como atividade acadêmica do curso técnico em **Desenvolvimento de Sistemas — Escola SESI de Referência**.

**AUmigos PetShop — Sistema de Cadastro e Gerenciamento de Clientes, Pets e Atendimentos.**

---

### AUmigos PetShop

*Organizando os dados para cuidar melhor dos nossos melhores amigos.*

