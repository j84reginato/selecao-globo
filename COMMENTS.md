# Comentários

## A escolha da linguagem

Como já informado em nossa conversa inicial no dia 22 de setembro, __PHP__ é a linguagem de programação com que tenho maior vivência profissional e domínio.
Apesar do desejo de me desafiar e desenvolver este projeto em __Golang__, uma linguagem que tenho tido bastante interesse (e estudado muito), nos últimos tempos, acabei optando por utilizar o PHP, pois acredito que assimn posso demonstrar mais detalhadamente as minhas habilidades desenvolvendo um código limpo, eficiente, escalável e performático.

O PHP evolui muito nos últimos anos deixando de ser apenas uma linguagem de _scripts_ e hoje conta com recursos poderosos que o colocam no mesmo nível das linguagens mais modernas.
A última grande versão do PHP foi 7. Esta versão foi um marco importante com desempenho significativamente aprimorado e menor uso de memória, além disso, com o uso de ferramentas como o Swoole ele agora conta com os recursos de programação assíncrona orientada a eventos.
A versão utilizada para desenvolver o código neste desafio foi a 7.4

## O uso de um framework

Decidi estruturar o projeto sobre um _microframework_ de forma a agilizar algumas tarefas comuns, sem contudo, engessar o processo de desenvolvimento.
Para isso, o escolhido foi o [Mezzio](https://docs.mezzio.dev/), um _microframework_ com suporte a ___HTTP messages___ e ___Midldlewares___.

## Demais dependências

Com o objetivo de tornar o processo de avaliação mais rápido resolvi por versionar a pasta vendor (a pasta de dependências do PHP, equivalente à node_modules do npm).
Assim não será necessário rodar os comandos do composer após baixar o código fonte.
Decidi por essa abordagem levando em conta que os containers já demoram certo tempo para _"subir"_, poupa-se assim alguns minutos para deixar o ambiente pronto!

## Configuração do ambiente de desenvolvimento

A aplicação fornece um `docker-compose.yml` para uso com [docker-compose](https://docs.docker.com/compose/).

Será executado os seguintes serviços:

+ **nginx**: image: nginx:latest
+ **php**: image: php:7.4-fpm
+ **cron**: image: php:7.4-fpm-alpine
+ **redis**: image: redis:latest
+ **elk**: image: sebp/elk:latest
+ **sonarqube**: image: sonarqube:7.9.4-community
+ **webgrind**: image: jokkedk/webgrind:latest

Obs: Os dois últimos serviços estão desabilitados para que o processo de _"subir"_ os containers seja menos demorado.
Estes serviços foram ferramentas utilizadas durante o desenvolvimento para análise do código.
Descomente as linhas no arquivo docker-compose, caso deseje utilizar o serviço.

Construa e inicie a imagem usando os comandos:

```bash
$ sudo ln -sf environment/development.env .env
$ sudo sysctl -w vm.max_map_count=262144
$ docker network create mm-gateway
$ docker-compose up --build
```

Ou simplestemente usando o atalho fornecido:

```bash
$ bin/runenv.sh
```

Neste ponto, você poderá visitar http://localhost:8181 (HTTP/HTTP1.1) ou http://localhost:8282 (HTTPS/HTTP2.0) para testar a execução da aplicação.

### ELK Stack

Nesta aplicação estou utilizando a ___ELK Stack___ para armazenar e consultar os logs.
A consulta pode ser realizada em: [http://localhost:5601](http://localhost:5601) e selecionando o index: `logstash-globo`

### SonarQube

Caso o container do __SonarQube__ seja instanciado a consulta poderá ser realizada em: [http://localhost:99](http://localhost:99)

<img align="middle" style="margin: 20px 0" src="https://imgur.com/xdBusoc.png" />


```
login = admin
senha = admin
```

As configurações estão no arquivo `sonar-project.properties`


No __docker container__ do serviço PHP eu instalei o `sonar-scanner`.
Portanto, é possivel rodar seus comando diretamente de dentro do container.

```bash
$ sudo docker-compose exec php sh
```

e em seguida:

```bash
$ sonar-scanner -Dsonar.login=YOUR-GENERATED-KEY
```

## Autenticação

Para acesso à api implementei uma autenticação JWT, sendo necessário um token gerado com a seguintes assinaturas:

```
ambiente dev: ehy8oowoq7nogzjajaaf788l4kwm7wbg2kw9y6s6
ambiente prd: bn80gp4od5e7y8zw7o72pdz52fugdlg0zn6wm83l
ambiente stg: dyjff4ykc77uoj6h60p9qmv8avuog994t0lhygw0
ambiente test: 5plcss2eg64cpgdu4gf91cvn1q0z12nmj7tm98vj
```

JWT Bearer Token previamente gerado:

```
eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJKb25hdGFuIE5vcm9uaGEgUmVnaW5hdG8iLCJleHAiOm51bGwsInN1YiI6IlNlbGVjYW9HbG9ibyIsImF1ZCI6Imdsb2JvLmNvbSIsImlhdCI6MTYwMTU5NTU4NH0.fOEYqku2p3iDuNyrqB_-xVkdrx3P8u_Kv96cAyR0YMI
```

## Testes

### Testes de carga

Para executar o teste de carga utilizei a ferramenta [Artillery](https://artillery.io/).
Conforme sugerido, o teste foi executado de forma a simular a garantia de que a API está pronta pra receber uma carga de 1000 requests/seg como baseline de performance.

<img align="middle" style="margin: 20px 0" src="https://imgur.com/pfzZQlc.png" />

### Testes unitários

Para executar os testes unitários você pode utilizar os seguintes comandos:

(Obs: Acessar o container caso não possua o PHP instalado localmente)

Todos os testes unitários:

```
composer test-unit
```

Testes unitários do domínio:

```
composer test-unit-domain
```

Para gerar o resultado de cobertura execute os seguintes comandos:

Todos os testes unitários:

```
composer test-unit-coverage
```

Testes unitários do domínio:

```
composer test-unit-domain-coverage
```

### Testes de integração

Infelizmente não houve tempo para gerar testes de integração, mas a estrutura está preparada.

### Cobertura de testes

Para visualizar os resultados dos testes acesse:

[http://localhost:8181/coverage/unit/index.html](http://localhost:8181/coverage/unit/index.html)

ou

[http://localhost:8181/coverage/integration/index.html](http://localhost:8181/coverage/integration/index.html)

## Monitoramento de erros

Ao se desenvolver uma aplicação esperasse que ela esteja 100% livre de erros. Contudo, imprevistos e situações inesperadas acontecem.
Para monitorar estes eventuais erros foi adicionado à aplicação um _listener_ de erros bastante conhecido no mercado, o [Bugsnag](https://app.bugsnag.com)

<img align="middle" style="margin: 20px 0" src="https://imgur.com/1RmvQ6T.png" />



*Qualquer dúvida e/ou solicitação estarei ao inteiro dispor!*


> **"O homem que trabalha somente pelo que recebe, não merece ser pago pelo que faz"** - *Abraham Lincoln*

