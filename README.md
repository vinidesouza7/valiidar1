
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
