# Control Media
Projeto com o objetivo de controle de mídia

## Levantando ambiente
Antes de tudo tenha instalado em sua máquina o `docker` e `docker-compose`.

Após o processo acima.
Entre na raiz do projeto e inicialize os containers com o comando `docker-compose up`.

OBS: dependendo das condições da conexão e de sua máquina, esse processo pode levar alguns minutos.

## Teste Unitário
Para Rodar o teste unitário roda esse seguinte comando:

`docker exec -it php_web composer run-script --dev test`

## Acessando o projeto
Para acessar entre na barra de endereço com essa url: 

`http://localhost:3000/` para o front com acesso a api

`http://localhost:8100/` para o back, a api em si

## Observação
Você deve se certificar que as portas(3100, 3306, 9906, 9907 e 8100) não estão sendo utilizada.

## Dicas importantes
Os containers são levantados e em seguida rodão todos os comandos normalmente, mas caso tenha algum problema de conexão pode ocorrer de certos comandos não serem executados perfeitamente

- docker exec -it php_web ./vendor/bin/doctrine-migrations migrate --no-interaction `(faz inserção de informações no banco)`
- docker exec -it php_web ./vendor/bin/doctrine orm:schema-tool:update --force `(atualiza as tabelas no banco)` 
- docker exec -it php_web composer install `(instala as dependências do php)`
- docker exec -it php_web composer run-script --dev test `(roda teste unitário)`

## Dúvidas
Qualquer dúvida entre em contato com wallace.sf87@gmail.com

