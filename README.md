# Plataforma Simples Produto
Mini Projeto de Produto para Analise

## Instalação Manual

Mantenha o servidor Atualizado
```
$ sudo apt-get update && sudo apt-get upgrade.
```
#### Requerimentos 

- curl: *sudo apt-get install curl.*
- Node.js Mínimo 8.x : Veja em  and build tools following instructions on https://nodejs.org/en/download/package-manager/#debian-and-ubuntu-based-linux-distributions.
- Git: https://git-scm.com/download/linux.
- Node: https://nodejs.org/en/
- Yarn: https://yarnpkg.com/en/docs/install#debian-stable.
- Dependencias PHP: * sudo add-apt-repository ppa:ondrej/php; sudo apt-get update; sudo apt-get install php7.2 php-pear php7.2-curl php7.2-dev php7.2-gd php7.2-mbstring php7.2-zip php7.2-mysql php7.2-xml.* 
- Dependencias: mysql-server

- Composer:
```
sudo mv composer.phar /usr/local/bin/composer | php
mv composer.phar /usr/local/bin/composer
```

### Instalando
```
$ cd folder_do_projeto
$ composer install
$ npm install
```

renomeie .env.example para .env
```
$ cp .env.example para .env
```

gere nova chave para aplicação
```
$ php artisan key:generate
```

limpe dados de cache

```
$ composer dump-autoload
$ php artisan clear-compiled
$ php artisan config:clear
$ php artisan cache:clear
```

Configure o .env (Acrescente senha do MySQL)
Crie um Banco de dados conforme nome informado no DB_DATABASE

Instale o banco, caso seja primeira instalação
```
$ php artisan migrate
```

Instale os dados básicos, caso seja primeira instalação
```
$ php artisan db:seed
```

### Rodando Ambiente Dev

FrontEnd
```
$ npm run watch
```

Backend
```
$ php artisan serve
```
