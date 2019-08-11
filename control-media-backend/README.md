# Control Media API
Projeto com o objetivo de controle de mídia

## Api's

| EndPoints                                                     | Tipo   | Descrição                                                                    |
| ------------------------------------------------------------- | ------ | -----------------------------------------------------------------------------| 
| `/media/`                                                     |`get`   | retorna uma lista de mídia                                                   |
| `/media/:id`                                                  |`get`   | retorna um registro pelo id.                                                 |
| `/media/create/`                                              |`post`  | Cria um novo registro.                                                       |
| `/media/update/`                                              |`put`   | Atualiza um cadastrado pelo id.                                              |
| `/media/:id`                                                  |`delete`| apaga um registro pelo id.                                                   |
| `/media/find-by/:firstResult/:maxResult/:columnOrder/:order/` |`get`   | retorna uma lista de mídia com paginação.                                    |
| `/person/`                                                    |`get`   | Cria um novo registro.                                                       |
| `/person/:id`                                                 |`get`   | retorna um registro de pessoa pelo id.                                       |
| `/person/create/`                                             |`post`  | cria uma pessoa.                                                             |
| `/person/update/`                                             |`put`   | atualiza uma pessoa cadastrada.                                              |
| `/person/:id`                                                 |`delete`| apaga um registro pelo id.                                                   |
| `/media-person-loan/create/`                                  |`post`  | cria um vinculo entre a pessoa e emprestimo (gera um emprestimo de mídia).   |
| `/media-person-loan/update/`                                  |`put`   | devolve um emprestimo de uma mídia, liberando a midia para novos emprestimos |

## Exemplos de alguns request's - Curl

##POST

Adicionar mais um novo registro de mídia :

    curl -X POST \
      http://localhost:8100/media/create/ \                  
      -H 'Connection: keep-alive' \
      -H 'Content-Type: application/json' \      
      -H 'cache-control: no-cache' \
      -d '{
        "title" : "Michael",
        "description": "Michal the champion 2010",
        "type": 1
    }'

##GET
Retorna uma midia cadastrado pelo id

    curl -X GET \
      http://localhost:8100/media/1 \  
      -H 'cache-Control: no-cache'      

Retorna uma lista de mídias com paginação.

OBS: parametros para ordenação : `media-id, media-title, media-description, type-description`  

      curl -X GET \
      http://localhost:8100/media/find-by/1/5/media-id/asc/ \      
      -H 'Cache-Control: no-cache' \      
      -H 'User-Agent: PostmanRuntime/7.15.2' \
      -H 'cache-control: no-cache'

Retorna todos as mídias cadastradas.
 
    curl -X GET \
      http://localhost:8100/media/ \
      -H 'cache-control: no-cache'

##DELETE
Apaga um registro do planeta pelo id.
    
    curl -X DELETE \
      http://localhost:8100/media/2 \
      -H 'cache-control: no-cache'
      
##UPDATE

Adicionar mais um novo registro de mídia :

    curl -X PUT \
      http://localhost:8100/media/update/ \                  
      -H 'Connection: keep-alive' \
      -H 'Content-Type: application/json' \      
      -H 'cache-control: no-cache' \
      -d '{
        "title" : "Michael",
        "description": "Michal the champion 2020",
        "type": 1
    }'      


## Dúvidas
Qualquer dúvida entre em contato com wallace.sf87@gmail.com