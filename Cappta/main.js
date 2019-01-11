$(function(){
    let payment = $('select#payment').val();
    let preco = $(".inputPreco").val();
    let json = {
        "AcquirerAffiliationKey":"135000100050000",
        "AcquirerAuthorizationCode":"079061",
        "AuthorizationDateTime":"2018-12-17T16:41:33",
        "AcquirerName":"Rede Stone",
        "AcquirerUniqueSequentialNumber":"SIMULADOR",
        "AdministrativeCode":"12770169011",
        "CardBrandName":"MAESTRO",
        "CustomerCardBin":"589916",
        "CustomerCardLastFourDigits":"5485",
        "CustomerReceipt":"\"         HOMOLOGACAO EXTERNO\"\r\n\"          34.555.898/0001-86\"\r\n\"           **VIA CLIENTE**\"\r\n\"           **REIMPRESSAO**\"\r\n\"              REDE STONE\"\r\n\"       MAESTRO - DEBITO A VISTA\"\r\n\"         **** **** **** 5485\"\r\n\"        ESTAB 135000100050000\"\r\n\"          17/12/18 16:41:33\"\r\n\"       AUT= 079061 DOC= 079061\"\r\n\"          NSU HOST SIMULADOR\"\r\n\"             VALOR= 10.00\"\r\n\"        CONTROLE= 12770169011\"\r\n\"  RECONHECO E PAGAREI A IMPORTANCIA\"\r\n\"                ACIMA\"\r\n\"    TRANSACAO AUTORIZADA MEDIANTE\"\r\n\"            CAPPTA CARTOES\"",
        "MerchantReceipt":"\"           **VIA LOJISTA**\"\r\n\"           **REIMPRESSAO**\"\r\n\"              REDE STONE\"\r\n\"       MAESTRO - DEBITO A VISTA\"\r\n\"         **** **** **** 5485\"\r\n\"        ESTAB 135000100050000\"\r\n\"          17/12/18 16:41:33\"\r\n\"       AUT= 079061 DOC= 079061\"\r\n\"          NSU HOST SIMULADOR\"\r\n\"             VALOR= 10.00\"\r\n\"        CONTROLE= 12770169011\"\r\n\"    TRANSACAO AUTORIZADA MEDIANTE\"\r\n\"  RECONHECO E PAGAREI A IMPORTANCIA\"\r\n\"                ACIMA\"\r\n\"            CAPPTA CARTOES\"",
        "PaymentProductName":"Débito à Vista",
        "PaymentTransactionAmount":10.00,
        "PaymentTransactionInstallments":1,
        "ReducedReceipt":"\"   REDE STONE - NL 135000100050000\"\r\n\"    MAESTRO - **** **** **** 5485\"\r\n\"       AUT= 079061 DOC= 079061\"\r\n\"  VALOR= 10.00 CONTROLE= 12770169011\"",
        "UniqueSequentialNumber":"079061"
                }
    $(document).on('click','.ok',function(){
        $.ajax({
            method:'post',
            url:'http://localhost/geradorXml/App/public/api/cappta',
            dataType: 'json',
            data: {payment,preco, json}
        }).done(function(data){
            console.log(data);
        });
    });
});