
![Logo](https://media.licdn.com/dms/image/C4E1BAQE4DfTAyYvpOw/company-background_10000/0/1652882563912/drugovichlabs_cover?e=2147483647&v=beta&t=dnkG-Tyr0yIeSNqFgs-6b0_0BY_MSe1OZa-3xpnGtaQ)


# Drugovich API

Teste Back-end PHP - Desenvolver uma API RESTful utilizando Laravel.

## Documentação da API (Scribe)

Documentação /docs

Gerente nível 1
gerente1@example.com
drugovich123@

Gerente nível 2
gerente2@example.com
drugovich123@
## Instalação

Clone o projeto

```bash
  git clone https://github.com/lucas-vallim/drugovich-api.git
```

Entre no diretório do projeto

```bash
  cd drugovich-api
```

Instalar as dependências

```bash
  composer install
```

Criar .env

```bash
  copy .env.example .env
```

Gerar APP_KEY

```bash
  php artisan key:generate
```

Configurar DB_CONNECTION

```bash
  Criar banco de dados

  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=drugovichapi
  DB_USERNAME=root
  DB_PASSWORD=
```

Executar as migrations

```bash
  php artisan migrate
```

Executar as seeders

```bash
  php artisan db:seed
```

Testar API

```bash
  URL   /docs
```

Recria e popula o banco de dados

```bash
php artisan migrate:fresh --seed
```
## Suporte

Para suporte, mande um email para lucas@lucasvallim.com.br


## Autor

- [@lucas-vallim](https://github.com/lucas-vallim)

