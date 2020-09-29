# Instruções para Utilização após clonar o repositorio

### 1. Instale as dependencias
```
cd teste_bh_software_rodolfo
composer install
npm install
```

### 2. Criar Banco de Dados
```
mysql> create database teste_bh_software;
```
### 3. Configurar database, usuário e senha dentro do arquivo .env
```
cp .env.example .env
DB_DATABASE=teste_bh_software
DB_USERNAME=USUARIO
DB_PASSWORD=SENHA
```

### 4. Gerar Chave de criptografia
```
php artisan key:generate
```

### 5. Subir migrations para seu database
```
php artisan migrate
```

### 6. Inicie localmente para use
```
php artisan serve
```


