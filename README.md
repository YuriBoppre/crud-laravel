Esse gerador de CRUD do Laravel cria, fornece e gera controladores, modelos e visualizações em Bootstrap/Tailwind CSS para o desenvolvimento de suas aplicações com um único comando. Fazendo com que se torne rápido e prático, basta aplicar suas regras de negócio e moldar como desejar. 

## Requisitos

* XAMPP
* PHP 8.2 ou superior
* MySQL 8 ou superior
* Composer

# Iniciando um projeto

Basta utilizar o seguinte comando
```
composer create-project laravel/laravel .  
```

## Passo a passo de como fazer um crud

Primeiramente montamos um model básico
```
php artisan make:model [NOME_MODEL} -m 
```
Em seguida, fazemos a migração para o banco
```
php artisan migrate
```
Após fazer a migração é necessário instalar e liberar o gerador de CRUD.
```
composer require ibex/crud-generator --dev
```

Em seguida, podemos finalmente criar o crud e suas rotas. Quando finalizar esse comandoele vai gerar uma linha copiável que vamos colar no arquivo web.php
```
php artisan make:crud [NOME_MODEL]
```
Essa foi a maneira de criar um crud simples


## Como verificar CRUDS gerados

Após realizar a etapa anterior e fazer a geração do CRUD desejado, podemos verificar as rotas
```
php artisan route:list
```

## Ocorreu algum erro na hora de migrar para o banco?

Pode tentar novamente atráves do comando
```
php artisan migrate
```
Ou fazer um rollback do que foi gerado e tentar novamente
```
php artisan migrate:rollback
```

## Rodando projeto

Assim que clonar, basta  iniciar o seu servidor de banco e fazer o comando:
```
php artisan migrate
```
Pois já vai estar com as tabelas necessárias para rodar, sem seguida, executar em ordem os seguintes comandos:
```
npm install
npm run build
php artisan serve     
```

Ao entrar no acesso fornecido, crie um login e assim vai ser direcionado para a parte dos CRUDS(Consultor, Compromisso)
