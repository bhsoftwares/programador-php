# Instruções para Utilização após clonar o repositorio

### 1. Criar Banco de Dados
```
mysql> create database teste_bh_software;
```
### 2. Configurar Usuário e senha dentro do arquivo .env
```
DB_DATABASE=USUARIO
DB_USERNAME=SENHA
```
### 3. Subir migrations para seu database
```
php artisan migrate
```

### 4. Inicie localmente para use
```
php artisan migrate
```


