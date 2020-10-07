![alt text](https://github.com/VinyVidal/binary-referral/blob/master/screenshot.png?raw=true)

** Passo a passo **

- Clone o repositório;
- Rode o comando "composer install" para instalar as dependencias;
- Copie o arquivo "env-example" e salve ele como ".env";
- Crie uma base de dados mysql (phpmyadmin) de nome "binary-referral", e Agrupamento (collation) deve ser "utf8mb4_unicode_ci";
- No arquivo ".env", mude o valor da váriavel "DB_DATABASE" para o "binary-referral" (o nome que foi colocado para o banco de dados);
- (Talvez não seja necessário) Rode o comando "php artisan key:generate" em um terminal na pasta do projeto;
- Rode "php artisan migrate" para estruturar o banco de dados;
- Rode "php artisan serve" e acesse http://localhost:8000/ para ver o projeto rodando.
