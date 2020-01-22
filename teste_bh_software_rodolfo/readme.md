# Instruções para Utilização após clonar o repositorio

### 3. Instale as dependencias
```
cd teste_bh_software_rodolfo
composer install
npm install
```

### 2. Criar Banco de Dados
```
mysql> create database teste_bh_software;
```
### 3. Configurar Usuário e senha dentro do arquivo .env
```
DB_DATABASE=USUARIO
DB_USERNAME=SENHA
```
### 4. Subir migrations para seu database
```
php artisan migrate
```

### 5. Inicie localmente para use
```
php artisan serve
```


