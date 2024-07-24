<h1>Mercado SoftExpert </h1>
<p> Este é um sistema simples de mercado desenvolvido em PHP para gerenciar produtos, tipos de produtos, impostos e vendas. O projeto permite o cadastro de produtos e seus tipos, bem como a definição de valores percentuais de imposto associados a cada tipo de produto. Além disso, o sistema oferece uma tela de venda onde é possível informar os produtos e quantidades adquiridas, e calcula o valor total da compra e o valor total dos impostos. As vendas são salvas no banco de dados.<br>

## Índice

- [Pré-requisitos](#requisitos)
- [Executando o Projeto](#usage)
- [Links](#links)
- [Autor](#autor)


## Pré-requistos <a name = "requisitos"></a>

- [x] GIT
- [x] Docker version 27.1.1
- [x] Docker Compose version v2.29.1
- [x] NPM

## Executando o Projeto <a name = "usage"></a>

Clone o repositório.
```
  git clone https://github.com/andersonvbs/softexpert.git
```

Após o clone, entrar na pasta do projeto para executar o docker.
```
 cd softexpert
```

Copie o arquivo `backend/.env.example` e cole-o no mesmo diretório com o nome `.env`. Em seguida, você pode modificar as informações conforme necessário, mas é recomendável manter o padrão fornecido para garantir o funcionamento adequado do sistema.

Executando o docker compose
```
  docker compose --env-file backend/.env up -d --build
```

Após iniciar o servidor, verifique se a pasta `node_modules` foi criada dentro do diretório `frontend`. Caso não tenha sido criada automaticamente, acesse o diretório ```frontend``` e execute a instalação manual das dependências com o comando:
```
  npm install
```

Agora acesse utilizando um navegador.
```
  http://localhost
```

## Links <a name = "links"></a>
<ul>
    <li><a href="https://react.dev/">React</a></li>
    <li><a href="https://insomnia.rest/download">Insomnia</a></li>
    <li><a href="https://www.docker.com/">Docker</a></li>
</ul>


## 📜 Licença <a name = "license"></a>

Este projeto está sob licença MIT. Veja o arquivo [LICENSE](LICENSE.md) para mais detalhes.

## Autor <a name = "autor"></a>

<a href="https://github.com/andersonvbs" target="_blank">Anderson Borges</a>

&#xa0;

<a href="#top">Voltar para o topo</a>

------------