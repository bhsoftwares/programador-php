```
Gabrie L. Garcia
```

# Guia para execução desta aplicação

## O que é necessário?
- Git instalado em sua máquina para clonar a aplicação
- Pelo menos o PHP 7.1.* instalado em sua máquina.
- Mysql Ver 8.0.19 *versão utilizada no desenvolvimento.
- Composer versão 1.9.1 *utilizada no desenvolvimento.


# Passos para execução da aplicação, após clonar o repositório.

## Instalar as dependências
```
cd PlataformaEnsino
composer install
```

## Gerar a Application Key
```
php artisan key:generate
```

## Criar Banco de Dados
Pode ser criado tanto por um SGBD, MySQl Workbench como em linha de comando.

```
mysql> create database bhsoftware;
```

## Configurar o arquivo .env.example com o Usuario e Senha de acessos ao banco
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bhsoftware
DB_USERNAME=Usuario
DB_PASSWORD=Senha
```
**Você deve renomear o arquivo .env.example para .env apenas.**


## Migrar as tabelas da aplicação para seu banco de dados
```
php artisan migrate
```

## Executar o servidor interno.
Dentro da pasta, PlataformaEnsino, executar o comando:
```
php artisan serve
<http://127.0.0.1:8000>
```
Clicar ou copiar o link para acessar a apliação diretamente pelo browser.


# Algumas outras funcionalidades.

**Caso queira popular a aplicação com dados fictícios, utilizar o comando:**

```
php artisan db:seed
```
Este comando criará 20 alunos com dados falsos, com a finalidade para testes

