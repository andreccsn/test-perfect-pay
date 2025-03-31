# Processador de pagamentos

Microserviço responsável por processar pagamentos em Gateways externos.

## Tecnologias envolvidas

| Languages | Frameworks   | Data  | Infra/Tools    | Techniques    |
|:----------|:-------------|:------|:---------------|:--------------|
| PHP 8.3   | PHPUnit      | MySQL | Docker         | Code Coverage |
|           | Laravel 11.9 |       | Docker Compose | Unit Test     |
|           |              |       | GIT            | REST API      |


## Descrição

Este projeto foi desenvolvido utilizando TDD como metodologia para implementação dos serviços, começando pelos testes
de integração e refatorando o código até chegar na arquitetura desejada.

A base do projeto foi utilizada à partir do repositório [Laravel examples](https://github.com/rw4lll/laravel-docker-examples.git).

### Pré requisitos
Tenha certeza de que você possui instalado em seu computador o `docker` e `docker compose` para conseguir rodar o 
projeto

```bash
docker --version
docker compose version
```
Se esses comandos não retornarem as respectivas versões, instale o `docker` e `docker compose` utilizando a documentação
oficial [Docker](https://docs.docker.com/get-docker/) e [Docker Compose](https://docs.docker.com/compose/install/)
If these commands do not return the 

### Clone o repositório 

```bash
git clone https://github.com/andreccsn/test-perfect-pay.git
cd test-perfect-pay
```

### Rodando o projeto

Execute os comando abaixo no console para subir o ambiente da aplicação

1. Gere o arquivo .env na raiz do projeto
```bash
$ cp .env.example .env
```

2. Gere uma chave de criptografia utilizada pelo Laravel.
```bash
$ ./workspace key:generate
```

3. Suba os conteiners da aplicação
```bash
$ docker compose up -d
```

4. Instale as dependências
```bash
$ ./composer install --prefer-dist
```

5. Execute as migrations
```bash
$ ./workspace migrate
```

Abra o browser e a aplicação estará disponível em: [http://localhost](http://localhost).

### Executando testes

Para rodar os testes de integração execute:

```bash
$ ./workspace test
```
