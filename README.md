# Racing Generator

Aplicação para cadastrar, listar e cancelar corridas.

## Dependências
- PHP 8.2
- Composer

## Como executar

### Docker
Em seu terminal de comando, execute:

```
$ cd pasta-de-downloads/racing-generator
$ docker-compose build
$ docker-compose up
```

### Artisan

Em seu terminal de comando, execute:

```
$ cd pasta-de-downloads/racing-generator
$ composer install
$ php artisan migrate --force
$ php artisan serve
```

## API

URL: http://10.6.0.6:8000 (Docker) / http://localhost:8000 (Server Local)

| Método   | URL | Body Request | Descrição                              |
| -------- | --------------|-------------------------- | ---------------------------------------- |
| `GET`    | `/api/racing` |                           | Listar todas as corridas.                |
| `GET`    | `/api/racing/{id}` |                       | Listar uma corrida.                      |
| `POST`   | `/api/racing` | { name: string, rules: string, date: 'd-m-Y H:i' }| Criar uma nova corrida.                  |
| `GET`    | `/api/racing/cancelled` |                  | Listar corridas canceladas.              |
| `DELETE` | `/api/racing/{id}`| | Deletar/Cancelar Corrida.|

## Porque o uso do Laravel?

Laravel é conhecido por ser um framework que preza pelo código limpo, e que possui uma boa estrutura, possibilitando que os desenvolvedores se preocupem apenas em escrever seus códigos enquanto a estrutura do projeto já está definida.

## Decisões técnicas e arquiteturais

Esse projeto já possui uma estrutura bem definida por conta do uso do Laravel. Porém, possui algumas adaptações para obter uma melhor organização ao se comunicar com o banco de dados e ao mesmo tempo separar as regras de negócio. Para isso foram criados os diretórios *Services* e *Repositories*. Sendo a *Service*, responsável por executar as regras de negocio e os *Repositories* por fazer o contato com o Banco de dados utilizando *Models*.

## Notas adicionais

### Controllers

Os *Controllers*, nesse projeto, tem o objetivo de somente receber a requisição que será validada por uma Classe de *Http Request*. Após isso, é chamada a *Service*, que entra em contato com o *Repository* para realizar o contato com o banco de dados, nesse caso, o *SQLite*. A resposta é retornada para o usuário por meio de Resources, para definir um melhor padrão de retorno.

### Testes

#### Controller

Foram realizados usando o teste de funcionalidade, presente no diretório tests/Feature, esse teste tem um objetivo de testar o fluxo real do controller, realizando um *rollback* das inserções relizadas durante o teste.

#### Services

Um teste unitário foi criado para a *RacingService*, o objetivo dele é testar as funções que podem conter regras de negocio. Nesse cenário, foi realizado um Mock das funcões do *Repository*, já que sua unica funcão é retornar/executar funções relacionadas a *Model*.