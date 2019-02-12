##Gerador XML <br/>
Esse é um gerador XML para autorizar NFC-e em ambiente de homologação com o sefaz, usando o software UniNFe da Unimake para assinatura digital do XML e o uniDANFE para geração do DANFE.

Esse projeto esta usando: <br />
Arquitetura Restfull Api;
Backend PHP; 
SGBD MySQL; 
Frontend JavaScript, jQuery

##Versão<br />
1.0.0

##Instalação<br />
Instalar o software da Unimake para assinatura do XML- UniNFe<br />
Instalar o software da Unimake para geração do DANFE- UniDANFE<br />
http://www.unimake.com.br/uninfe/

##Criar o CSC e o ID Token no site do Sefaz:<br />
Passo a passo das configurações em - http://wiki.unimake.com.br/index.php/Manuais:UniNFe<br />

##API Endpoints<br />
Grupo: Cliente 

    $ GET /api/cliente/

    $ GET /api/cliente/{id}

    $ POST /api/cliente/add

    $ PUT /api/cliente/update/{id}

    $ DELETE /api/cliente/delete/{id}

Grupo: Emissor 

    $ GET /api/emissor/

    $ POST /api/emissor/add

    $ PUT /api/emissor/update/{id}

    $ DELETE /api/emissor/delete/{id}

Grupo: NF 

    $ GET /api/nf/

    $ POST /api/nf/add

    $ PUT /api/nf/update/{id}

    $ DELETE /api/nf/delete/{id}

Grupo: Produto 

    $ GET /api/produto/

    $ GET /api/produto/{id}

    $ POST /api/produto/add

    $ PUT /api/produto/update/{id}

    $ DELETE /api/produto/delete/{id}
