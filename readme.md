## API Seminovos

RESTful API PHP para extrair dados dos veículos do site [Seminovos BH](https://seminovos.com.br/).

#### Dependências

 - PHP: ^7.2,
 - Lumen-framework: 6.0

### Instalação

 1. Baixe o projeto, navegue até a pasta e utilize o [Composer](https://getcomposer.org/) para instalar as dependências.


	```
	composer install
	```
 2. Inicie o ambiente php.
	```
	php -S localhost:8080 -t public
	```
	> Pode-se utilizar qualquer ambiente PHP.

## Uso

Esta API possui basicamente dois endpoints, um para consulta de veículos de acordo com os filtros desejados e outro para exibir detalhes de um veículo específico.

### Endpoints

**Método [GET]**

 - Endpoint para consultar veículo de acordo com os filtros desejados

	```
	 http://localhost:8080/api/
	```
	**Parâmetros Body**

	| Campo  |  Tipo  | Descrição | Observação|
	|--|--|--|--|
	| tipo|string|Tipo do veículo.| Campo obrigatório. <br/>Aceita as strings "moto","carro" e "caminhão".
	| marca |string| Marca do veículo. | Campo Opcional. |
	| modelo|string| Modelo do veículo. | Campo Opcional. |
	| anoModeloDe|string| Ano inicial para a busca  do ano do veículo. | Campo Opcional. <br/>Formato "0000" |
	| anoModeloAte|string| Ano final para a busca  do ano do veículo. | Campo Opcional. <br/> Formato "0000" |
	| precoMin|int| Preço mínimo para a busca do veículo. | Campo Opcional. <br/>Aceita valores entre 2000 e 40000|
	| precoMax|string| Preço máximo para a busca do veículo. | Campo Opcional. <br/>Aceita valores entre o preço mínimo e 2000000|
	| kmMin|int| Kilometragem mínima para a busca do veículo. | Campo Opcional. <br/>Aceita valores entre 0 e 100000|
	| kmMax|int| Kilometragem máxima para a busca do veículo. | Campo Opcional. <br/>Aceita valores entre o preço mínimo e 2000000|
	| origem|string| Origem do veículo. | Campo Opcional.<br/>Aceita as strings "particular" e "revenda" .|
	| financiamento|int| Veículo com ou sem financiamento. | Campo Opcional.<br/>Aceita os valores:<br/>1 - Com financiamento<br/>2- Sem financiamento|
	| troca|int| Se aceita troca ou não. | Campo Opcional.<br/>Aceita os valores:<br/>4 - Aceita troca|
	| cidade|array(int)| Cidades utilizada para busca | Campo Opcional.<br/>Formato: [1.2.3]|
	| versao|string| Versão do veículo | Campo Opcional.|
	| listaAcessorios|array(int)| Lista de acessórios do veículo | Campo Opcional. <br/>Formato: [1,2,3,5]<br/>Aceita os valores:<br/> 11- Cambio automático <br/> 	60 - CambioManual <br/> 	78 - Cambio automatizado <br/> 	2 - 1 AIR BAG <br/> 	3 - 2 AIR BAGS <br/> 	67 - 3 AIR BAGS <br/> 	52 - 4 AIR BAGS <br/> 	68 - 5 AIR BAGS <br/> 	69 - 6 AIR BAGS <br/> 	70 - 7 AIR BAGS <br/> 	71 - 8 AIR BAGS <br/> 	72 - 9 AIR BAGS <br/> 	73 - 10 AIR BAGS <br/> 	74 - 11 AIR BAGS <br/> 	75 - 12 AIR BAGS <br/> 	1 - ABS <br/> 	4 - ALARME <br/> 	76 - AWD <br/> 	10 - BLINDADO <br/> 	61 - CONTROLE ESTABILIDADE <br/> 	62 - CONTROLE TRAÇÃO <br/> 	49 - FAROL XENÔNIO <br/> 	53 - SENSOR DE RÉ <br/> 	32 - TRAÇÃO 4x4 <br/> 	77 - 7 Lugares <br/> 	6 - AR CONDICIONADO <br/> 	9 - BANCOS DE COURO <br/> 	59 - CÂMERA DE RÉ <br/> 	51 - CD / MP3 <br/> 	56 - CENTRAL MULTIMIDIA <br/> 	14 - COMPUTADOR DE BORDO <br/> 	66 - CONVERSÍVEL <br/> 	15 - DESEMBAÇADOR <br/> 	16 - DIREÇÃO ELÉTRICA <br/> 	17 - DIREÇÃO HIDRÁULICA <br/> 	18 - DVD <br/> 	63 - GPS <br/> 	22 - MP3 / USB <br/> 	23 - PILOTO AUTOMÁTICO <br/> 	27 - RETROVISORES ELÉTRICOS <br/> 	30 - TETO-SOLAR <br/> 	33 - TRAVAS ELÉTRICAS <br/> 	35 - VIDROS ELÉTRICOS <br/> 	50 - VOLANTE AJUSTÁVEL <br/> 	12 - CAPOTA MARÍTIMA <br/> 	19 - ENGATE <br/> 	20 - FARÓIS DE MILHA <br/> 	21 - LIMPADOR TRASEIRO <br/> 	24 - PROTETOR DE CAÇAMBA <br/> 	57 - REBAIXADO <br/> 	28 - RODAS DE LIGA LEVE <br/> 	58 - TURBO |
	| combustivel|int| Tipo de combustível do veículo | Campo Opcional. <br/>Aceita os valores:<br/>1 - Álcool <br/>2 - Bi-Combustível <br/>3 - Diesel <br/>4 - Gasolina <br/>5 - Gasolina + Kit Gás <br/>6 - Kit Gás <br/>7 - Tetra Fuel|
	| cor|string| Cor do veículo | Campo Opcional.|
	| portas|int| Quantidade de portas do veículo. | Campo Opcional.<br/>Aceita valores entre 1 e 6.|
	| pagina|int| Paginação. | Campo Opcional.<br/>|

	**Exemplo de resposta**
	```JS
		{
		    "pagina": "1",
		    "totalPaginas": "253",
		    "carros": [
	        {
	            "id": "2611234",
	            "img": "https://carros.seminovosbh.com.br/fiat-uno-2010-2011-2611234-1840c120ba476a9c1cbe2d6249b653439015.jpg",
	            "marcaModelo": "Fiat Uno",
	            "preco": "R$ 18.400,00",
	            "versao": "VERSÃO: 1.0 16v Vivace",
	            "ano": "2010-2011",
	            "km": "105 km",
	            "origem": "Particular",
	            "cambio": "Não Informado",
	            "listaAcessorios": [
	                "ALARME,",
	                "AR CONDICIONADO,",
	                "AR QUENTE,",
	                "CD / MP3,",
	                "DIREÇÃO HIDRÁULICA,"
	            ]
	        },
	        {
	            "id": "2661315",
	            "img": "https://carros.seminovosbh.com.br/fiat/siena/2004/2005/2661315/49276c6dfc7616835e52d281452403d1861f",
	            "marcaModelo": "Fiat Siena",
	            "preco": "R$ 14.250,00",
	            "versao": "VERSÃO: HLX 1.8 mpi Flex 8V 4p",
	            "ano": "2004-2005",
	            "km": "126.500 km",
	            "origem": "Particular",
	            "cambio": "Manual",
	            "listaAcessorios": [
	                "AR CONDICIONADO,",
	                "CÂMBIO MANUAL,",
	                "CD / MP3,",
	                "COMPUTADOR DE BORDO,",
	                "DIREÇÃO HIDRÁULICA,"
	            ]
	        },
	        (...)
	    ]
	}
		
	```
---
**Método [GET]**
 - Endpoint para consultar os detalhes de um veículo específico.

	```
	 http://localhost:8080/api/{id}
	```
	**Parâmetros da URL**
	| Campo|tipo  |Descrição|Observação|
	|--|--|--|--|
	| id |int  | Id do veículo | Campo obrigatório
	**Exemplo de resposta**
	```JS
	{
	    "id": "2633386",
	    "marcaModelo": "BMW X2",
	    "preco": "R$ 190.000,00",
	    "versao": "SDRIVE 20i M Sport 2.0 TB 192cv Aut.",
	    "ano": "2018/2018",
	    "km": "14.000 Km",
	    "cambio": "Automático",
	    "cor": "Cinza",
	    "placa": "QOE",
	    "troca": "Não Aceita Troca",
	    "obs": "Todos opcionais, veículo sem nenhum detalhe.",
	    "img": [
	        "https://tcarros.seminovosbh.com.br/mini_bmw-x2-2018-2018-2633386-8721fee0afe011e2450a358308ec68b91558.jpg",
	        "https://tcarros.seminovosbh.com.br/mini_bmw-x2-2018-2018-2633386-910ce4bad3af41e54a26e76f8693756499c.jpg",
	        "https://tcarros.seminovosbh.com.br/mini_bmw-x2-2018-2018-2633386-9477b4916c5e206bf2a30cf846ea0eb068cf.jpg",
	        "https://tcarros.seminovosbh.com.br/mini_bmw-x2-2018-2018-2633386-665139d8f7fb24fc2b64b54b3eb0f32e3e11.jpg",
	        "https://tcarros.seminovosbh.com.br/mini_bmw-x2-2018-2018-2633386-233df17e8f289ec12823404821963e356bf.jpg",
	        "https://tcarros.seminovosbh.com.br/mini_bmw-x2-2018-2018-2633386-7393652543647d1fd4918a9e533b756d3de2.jpg",
	        "https://tcarros.seminovosbh.com.br/mini_bmw-x2-2018-2018-2633386-9584ffe5f28f903fd8591c8517a5b6fc2fc.jpg",
	        "https://tcarros.seminovosbh.com.br/mini_bmw-x2-2018-2018-2633386-8180c4942f9cf3c74475a906c5e8bbe3d03f.jpg",
	        "https://tcarros.seminovosbh.com.br/mini_bmw-x2-2018-2018-2633386-1687a221589a0f9e804322267cb5a54344cb.jpg",
	        "https://seminovos.com.br/img/sample/sample-thumb.jpg",
	        "https://seminovos.com.br/img/sample/sample-thumb.jpg",
	        "https://seminovos.com.br/img/sample/sample-thumb.jpg"
	    ],
	    "listaAcessorios": [
	        "7 LUGARES",
	        "ABS",
	        "ALARME",
	        "AR CONDICIONADO",
	        "BANCOS DE COURO",
	        "CÂMBIO AUTOMÁTICO",
	        "CÂMERA DE RÉ",
	        "CENTRAL MULTIMIDIA",
	        "COMPUTADOR DE BORDO",
	        "CONTROLE ESTABILIDADE",
	        "CONTROLE TRAÇÃO",
	        "DIREÇÃO ELÉTRICA",
	        "FARÓIS AUXILIARES",
	        "FAROL XENÔNIO",
	        "GPS",
	        "LIMPADOR TRASEIRO",
	        "MP3 / USB",
	        "PILOTO AUTOMÁTICO",
	        "RETROVISORES ELÉTRICOS",
	        "RODAS DE LIGA LEVE",
	        "SENSOR DE RÉ",
	        "TETO-SOLAR",
	        "TRAVAS ELÉTRICAS",
	        "TURBO",
	        "VIDROS ELÉTRICOS",
	        "VOLANTE AJUSTÁVEL"
	    ]
	}
	```



## Exceções

 - Tipo de veículo não informado
	 ```JS
	{
	"tipo": [
		"The tipo field is required."
		]
	}
	```
 -  Nenhum resultado encontrado
	 ```
	 "Nenhum resultado encontrado."
	 ```
