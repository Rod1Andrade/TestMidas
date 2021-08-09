# Explicação da abordagem da questão 1 da fase 2.

## Como executar esse projeto?

1. Clone o repositório

```shell
$ git clone https://github.com/Rod1Andrade/TestMidas.git
```

2. Acesse a pasta do projeto e rode o comando de instação do composer.
```shell
$ cd TestMidas
$ cd Phase2
$ composer install
```

3. Basta subir um servidor embutido do PHP
```shell
$ composer dev
```
ou 
```shell
$ php -S localhost:8000 -t public
```

## Como acesso o caso de uso esperado?

Uma vez que o projeto esta instalado e o servidor esta rodando,
basta acessar a url:

```
http://localhost:8000/phase2/question1/99901
```

## Problema

Com base no modelo apresentado desenvolva uma função em PHP que leia a tabela CONTEUDO (apresentada no modelo acima) e
monte uma lista ordenada em estrutura de árvore utilizando os elementos HTML ``<ul> e <li>`` conforme imagem abaixo (
imagem disponibilizada no problema). Essa função deve receber como parâmetro obrigatoriamente o ID da imobiliária, mas
pode receber outros parâmetros se você julgar necessário Esta lista ordenada monta o mapa do site da imobiliária e deve
prever níveis infinitos.

Obs: as QUERIES realizadas devem ficar explicitas no código, assim como a montagem das tags de lista ordenada. Enviar
link do github com o seu código.

## Arquitetura de pastas
```
├── public
    └── index.html
├── src
    └── Database/
        └── Connections/
            └── Connection.php
            └── MySqlConnection.php
        └── Http/
            └── Controllers/
                └── AppController.php
        └── Repositories/
            └── AppRepository.php
        └── Views/
            └── content.twig.html
            └── nav.twig.html
├── .env
├── .gitignore
```

## Componentes utilizados

```json
{
  "require": {
    "php": ">=8.0",
    "vlucas/phpdotenv": "^5.3",
    "ext-pdo": "*",
    "slim/slim": "^4.8",
    "nyholm/psr7": "^1.4",
    "nyholm/psr7-server": "^1.0",
    "guzzlehttp/psr7": "^2.0",
    "http-interop/http-factory-guzzle": "^1.2",
    "laminas/laminas-diactoros": "^2.6",
    "slim/twig-view": "^3.2",
    "php-di/slim-bridge": "^3.1"
  }
}
```

## Onde encontra-se o que foi pedido?

Para encontrar as queries escritas basta ir no ``AppRepository.php`` e para encontrar a criação do ``<UL> e <LI>`` menu com sub niveis infinitos, 
basta ir em ``views/content.twig.html``.

## Motivo dessa arquitetura

O motivo para estruturar o problema dessa maneira foi dividir a responsabilidade
de cada parte do código e estruturar uma chamada coerente da view sendo alimentada por um
controller que faz uso de um repository.

O ``index.php`` tornou-se um arquivo de configuração do slim framework
e definição dos componentes de views e rotas.

Vale ressaltar que poderia ser utilizados mais componentes e recursos para
ter um projeto mais rico no quesito de criação de componentes, configuração e definição
de rotas.

# Conclusão

Foi um desafio interessante implementar essa rotina, visto que eu nunca havia feito algo parecido.
E definir uma arquitetura mais solida ajudou a clarear meus pensamentos 
e definir uma abordagem de ação para o problema apresentado.
