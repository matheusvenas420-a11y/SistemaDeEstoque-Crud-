# Sistema de Estoque

## Sobre o projeto

Esse projeto foi desenvolvido para uma atividade prática de desenvolvimento de sistemas. A ideia é criar um sistema de estoque onde seja possível cadastrar produtos e gerenciar as informações de cada um.

## Tecnologias utilizadas

- PHP
- HTML e CSS
- MariaDB
- PDO para conectar o PHP ao banco de dados
- XAMPP para executar o projeto
- DBeaver para gerenciar o banco de dados

## O que o sistema faz?

- Cadastra produtos.
- Mostra os produtos cadastrados.
- Pesquisa produtos pelo nome ou código.
- Permite editar os produtos.
- Permite excluir produtos.
- Mostra mensagens de sucesso e erro.
- Salva as informações no banco de dados.
- Possui uma interface estilizada com CSS.

## Como configurar o banco de dados

Primeiro, abra o DBeaver e conecte ao seu MariaDB. Depois, execute os comandos abaixo para criar o banco e a tabela:

```sql
CREATE DATABASE sistema_estoque
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE sistema_estoque;

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(30) NOT NULL UNIQUE,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL DEFAULT 0
);
```

A tabela `produtos` guarda as informações de cada produto:

- `id`: número de identificação do produto.
- `codigo`: código do produto.
- `nome`: nome do produto.
- `descricao`: descrição do produto.
- `preco`: preço do produto.
- `quantidade`: quantidade disponível no estoque.

## Configuração da conexão

O arquivo `config/conexao.php` é responsável por conectar o sistema ao banco de dados.

No meu projeto, estou utilizando estas configurações:

```php
$host = '127.0.0.1';
$banco = 'sistema_estoque';
$usuario = 'root';
$senha = '';
```

Esses dados funcionam na minha configuração local. Se o banco estiver usando outra porta, usuário ou senha, será necessário ajustar o arquivo de conexão.

## Como executar o projeto

1. Instale e abra o XAMPP.
2. Inicie o Apache.
3. Verifique se o MariaDB está funcionando.
4. Coloque a pasta `SistemaEstoque` dentro de `C:\xampp\htdocs\`.
5. Abra o DBeaver e crie o banco de dados usando os comandos acima.
6. Confira se os dados do arquivo `config/conexao.php` estão corretos.
7. Abra o navegador e acesse:

Apache na porta 81: http://localhost:81/SistemaEstoque/

Apache na porta 80: http://localhost/SistemaEstoque/

## Como testar

Depois de abrir o sistema, você pode:

1. Cadastrar um produto.
2. Verificar se ele aparece na listagem.
3. Pesquisar pelo nome ou código.
4. Editar as informações.
5. Excluir o produto.

Os dados ficam salvos no banco de dados, então não são perdidos só porque você fechou o navegador.

## Links para entrega

**GitHub:** colocar aqui o link do repositório.

**Vídeo do projeto:** colocar aqui o link do vídeo mostrando o sistema funcionando.
