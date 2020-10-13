# Padrão de Commit

O padrão de *commit* utilizado para esse projeto foi baseado no padrão bastante conhecido e usado pelo [Angular](https://github.com/angular/angular/blob/master/CONTRIBUTING.md#commit), [Karma](http://karma-runner.github.io/1.0/dev/git-commit-msg.html) e outros:

Estrutura:

```
<tipo>(<escopo>): <descrição>
<LINHA EM BRANCO>
<corpo>
<LINHA EM BRANCO>
<rodapé>
<LINHA EM BRANCO>
<observações>
```

Exemplo:

```
fix(routes/map): adjust argument of drawDirections function

drawDirections used to receive argument of description XPTO.
Now receives the correct argument of description FOO.

Solves issue #PCT-88
```

A ideia de usar um padrão, é termos de forma granulada o que cada *commit* fez e em o quê.
Além disso, facilita na hora de extrair algum *changelog* da aplicação e além de melhorar a visualização do *log* sem *commits* vagos.

Utilizei seis regras e elas são as seguintes:

* Os *commits* devem ser [atômicos](https://en.wikipedia.org/wiki/Atomic_commit#Atomic_commit_convention); se duas implementações/correções distintas são realizadas, elas devem ser implementadas em dois *commits* diferentes;
* O tipo do cabeçalho é obrigatório e o escopo do cabeçalho é opcional;
* Cada linha do *commit* terá no máximo 100 caracteres;
* A compreensão do conteúdo do *commit* deve ser quase que automática para qualquer contribuidor e de fácil compreensão para novos contribuidores;
* A mensagens de rodapé, quando presente, deve fazer referência ao número da tarefa no **Jira** associada ao *commit*;
* Os tipos, escopos, descrições, conteúdo do corpo e rodapé devem ser devidamente declarados.

Para uma melhor compreensão da importância de um *commit* descritivo e alguns exemplos, leia:

- [chris beams](https://chris.beams.io/posts/git-commit/) e
- [tbaggery](http://tbaggery.com/2008/04/19/a-note-about-git-commit-messages.html).

## Tipo

Os **Tipos** se resumem em ***feat***, ***fix***, ***refactor***, ***style***, ***chore***, **env**, ***doc***, ***test*** e ***revert***

### feat

`feat` são quaisquer adições ao código.

Enquanto elas podem alterar parte do código já existente, o foco dela é a implementação de *features* novas ao ecossistema ou incrementos em *features* existentes.

Exemplos:

`feat(login): create login page`

`feat(routes): add click functions on map markers`

### fix

`fix` refere-se às correções de *bugs*.

Exemplos:

`fix(login): add description="email" to login form`

`fix(dashboard): fix decimal point error`

### refactor

`refactor` refere-se a quaisquer mudanças que atinjam o código, porém não alterem sua funcionalidade.

Alterou o formato de como é o processamento em determinada parte da sua tela, mas manteve a mesma funcionalidade? Declare como *refactor*.

Exemplos:

`refactor(style): use sass mixins to handle darken backgrounds`

`refactor(login): use arrow function on Array.map`

### style

Alterações referentes a formatações de código, *semicolons*, *trailing spaces* e *lint* em geral são em `style`.

### chore

`chore` será utilizado para qualquer alteração de arquitetura.
Seja alteração do composer.json ou algum arquivo de configuração, ou mesmo alteração da organização de pastas/código do projeto.

Exemplos:

`chore: add run/env script`

`chore: organize components by features`

### env

`env` será utilizado para as funções como atualizações de arquivos `.env`, `docker`, `CI`, `build files`, `tasks runners` ou configurações, por exemplo:

Exemplos:

`env(docker): add a node script to DockerFile`

Obs: vale notar que esse é um tipo personalizado e foge das especificações do ***conventional commit***.

### doc

Com `doc`, temos conteúdo relativo à documentação.
Será usado ao adicionar comentários no código, phpdoc, jsdoc, storyboard e tudo que não interfira no código, porém indique o funcionamento do mesmo.

Exemplos:

`docs(login): add jsdoc to functions`

`docs(login): components from login inserted on storyboard`

### test

`test` será usado ao realizar commits relacionados às modificações e adições aos testes unitários e/ou end-to-end.

Exemplos:

`test(login): add unit test`

`test(dashboard): add e2e test`

### revert

Se o *commit* reverter um *commit* anterior, ele deve começar com `revert`, seguido pelo cabeçalho do *commit* revertido.
No corpo, deve-se dizer `this reverts commit <hash>`, onde o *hash* é o **SHA** do *commit* que está sendo revertido.

Exemplo:

`revert: this reverts commit 74a9ef`

## Escopo

Escopos podem ser quaisquer partes do projeto;
é importante que eles sejam compreendidos de uma maneira quase automática para alguém que não conhece o projeto.
Em geral, a utilização do escopo é bem genérica, especificando apenas o primeiro contexto (login, middleware, profile).
No entanto, prefira ser mais específico e defina um segundo escopo (containers/login, por exemplo).

Supondo que você tenha feito uma refatoração nas rotas relativas as *settings* do projeto, uma possibilidade de *commit* seria:

`feat(routes/settings): adjust settings to be called in any screen`

## Descrição

As descrições devem ser suficientemente claras, utilizando seu espaço até o máximo permitido da linha.
Caso você veja que a explicação não foi suficiente, sinta-se à vontade para adicionar conteúdo ao corpo.

* Deve conter a descrição sucinta da alteração:
* Use o imperativo: "corrige" e não "corrigiu", "corrigindo" ou "correção";
* Inicie a frase com letra minúscula;
* Sem ponto (.) no final.

## Corpo

O corpo, por sua vez, deve conter descrições mais precisas do que está contido naquele *commit*,
mostrando as razões ou consequências geradas por esse código, assim como instruções futuras.

Se existir uma mudança drástica que quebrará funcionalidades, você DEVE obrigatóriamente indicar no corpo com
‘BREAKING CHANGE’ (sim, em caixa alta) e explicar as razões que levaram a essa marcação.

Dica: Configure seu editor([nano¹](http://stackoverflow.com/a/31844714),
[Vim²](https://robots.thoughtbot.com/5-useful-tips-for-a-better-commit-message)) para quebrar a linha em 100 caracteres.

## Rodapé

O rodapé restringe-se às alterações de estado via ***smart commit***, como resoluções de estado de *issues*.
A idéia é que no futuro seja possível com ***smart commits*** associar o *commit* a uma *issue* do *Jira* e alterar
seu estado automaticamente com keywords como `resolve`, `fix`, `solves`.

Exemplo: ‘resolves issue #PCT-99’.

## Observações

Este campo deve ser usado para fazer referência a outras *issues* / *tasks* / *histories*, débito técnico e demais links relevantes.
