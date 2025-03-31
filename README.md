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

Execute o comando abaixo no console e toda a configuração necessária para rodar o projeto será executada.

```bash
$ ./setup
```

Abra o browser e a aplicação estará disponível em: [http://localhost](http://localhost).
