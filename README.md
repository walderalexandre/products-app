# Back-end do Projeto

Este é o back-end do projeto, desenvolvido em **Laravel**. Ele fornece uma API RESTful para gerenciar produtos, incluindo operações de criação, leitura, atualização e exclusão (CRUD).

## Tecnologias Utilizadas

- **Laravel**: Framework PHP para desenvolvimento web.
- **MariaDB**: Banco de dados relacional.
- **API RESTful**: Endpoints para manipulação de dados.
- **UUID**: Identificadores únicos para os registros.
- **Resources**: Transformação de dados para respostas da API.
- **PHPUnit**: Para testes de features

## Requisitos

- PHP >= 8.0
- Composer
- MySQL
- Laravel CLI

## Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/backend-projeto.git
   cd backend-projeto

2. Instale as dependências:
    ```bash
    composer install

3. Configure o arquivo .env:
    Copie o arquivo .env.example para .env.
    Configure as variáveis de ambiente, como DB_DATABASE, DB_USERNAME e DB_PASSWORD.

4. Gere a chave do Laravel:
    ```bash
    php artisan key:generate

5. Execute as migrations:
    ```bash
    php artisan migrate

6. Inicie o servidor:
    ```bash
    php artisan serve

    O servidor estará disponível em http://localhost:8000.


## Endpoints da API

    GET /api/products: Lista todos os produtos.

    GET /api/products/{id}: Retorna um produto específico.

    POST /api/products: Cria um novo produto.

    PUT /api/products/{id}: Atualiza um produto existente.

    DELETE /api/products/{id}: Exclui um produto.

## Execução dos testes

O projeto utiliza PHPUnit para testes automatizados.

    ```bash
    ./vendor/bin/phpunit
