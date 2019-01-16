
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.40/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.33/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<html lang='en'>
<head>
  <meta charset='utf-8'>
  <title>pdfmake Example</title>
  <!-- Source: https://github.com/bpampuch/pdfmake -->
</head>
<body>
  <script>
$(()=>{
    
                //DANFE
                let DANFE = true;
                $.ajax({
                    method: 'post',
                    url: 'http://localhost/geradorXml/App/public/api/DANFE',
                    dataType: 'json',
                    data:{DANFE:DANFE}
                }).done(function(data){
                    // Object of object to array of object
                    let arrayDANFE = Object.keys(data).map(key => data[key]); 
                    var docDefinition = {
                        pageSize: 'A4',
                        pageMargins: [ 50, 10, 50, 10 ],
                        content: [
                            {
                                    text: 'CNPJ: '+arrayDANFE[0][4].CNPJ+' '+arrayDANFE[0][4].xNome,
                                    alignment: 'left'
                            },
                            {
                                text: arrayDANFE[0][4].xLgr+' '+arrayDANFE[0][4].nro+', '+arrayDANFE[0][4].xBairro+', '+arrayDANFE[0][4].xMun+', '+arrayDANFE[0][4].UF,
                                alignment: 'left'
                            },
                            {
                                text: 'Documento Auxiliar da Nota Fiscal de Consumidor Eletrônica\n\n',
                                alignment: 'left'
                            },
                            {
                                alignment: 'left',
                                columns:[
                                    {
                                        text: 'Código'
                                    },
                                    {
                                        text: 'Descrição'
                                    },
                                    {
                                        text: 'Qnt e UN'
                                    },
                                    {
                                        text: 'Vl Unit'
                                    },
                                    {
                                        text: 'Vl Total'
                                    }
                                ]
                            },
                            {
                                alignment: 'left',
                                columns:[
                                    {
                                        text: arrayDANFE[1][0].id
                                    },
                                    {
                                        text: arrayDANFE[1][0].descricao
                                    },
                                    {
                                        text: arrayDANFE[1][0].quantidade + '   '+ 'UN'
                                    },
                                    {
                                        text: arrayDANFE[1][0].preco
                                    },
                                    {
                                        text: arrayDANFE[1][0].preco * arrayDANFE[1][0].quantidade
                                    }
                                ]
                            },
                            {
                                columns:[
                                    {
                                        alignment: 'left',
                                        text: 'Qtde. total de itens'
                                    },
                                    {
                                        alignment: 'right',
                                        text: 'Qtde. total de itens'
                                    }
                                ],
                            },                            
                            {
                                columns:[
                                    {
                                        alignment: 'left',
                                        text: 'Valor total R$'
                                    },
                                    {
                                        alignment: 'right',
                                        text: 'Valor total R$'
                                    }
                                ]
                            },
                            {
                                columns:[
                                    {
                                        alignment: 'left',
                                        text: 'Desconto R$'
                                    },
                                    {
                                        alignment: 'right',
                                        text: 'Desconto R$'
                                    }
                                ]
                            },
                            {
                                columns:[
                                    {
                                        alignment: 'left',
                                        text: 'Frete R$'
                                    },
                                    {
                                        alignment: 'right',
                                        text: 'Frete R$'
                                    },
                                ]
                            },
                            {
                                columns:[
                                    {
                                        alignment: 'left',
                                        text: 'Valor total R$'
                                    },
                                    {
                                        alignment: 'right',
                                        text: 'Valor total R$'
                                    },
                                ]
                            },
                            {
                                columns:[
                                    {          
                                        alignment: 'left',                              
                                        text: 'Valor a Pagar R$',
                                        bold: true
                                    },
                                    {          
                                        alignment: 'right',                              
                                        text: 'Valor a Pagar R$',
                                        bold: true
                                    },
                                ]
                            },
                            {
                                columns:[
                                    {          
                                        alignment: 'left',                              
                                        text: '\nFORMA PAGAMENTO'
                                    },
                                    {          
                                        alignment: 'right',                              
                                        text: '\nVALOR PAGO R$'
                                    },
                                ]
                            },
                            {
                                columns:[
                                    {          
                                        alignment: 'left',                              
                                        text: 'EX: Cartão de Crédito'
                                    },
                                    {          
                                        alignment: 'right',                              
                                        text: '1.050,00'
                                    },
                                ]
                            },
                            {
                                text: '\nConsulta pela Chave de Acesso',
                                alignment: 'center',
                                bold: true
                            },
                            {
                                text: arrayDANFE[2],
                                alignment: 'center'
                            },
                            {
                                width: '*',
                                alignment: 'center', 
                                text:
                                [
                                    {                                            
                                        text: '\nCONSUMIDOR ',
                                        bold: true
                                    },
                                    {                                            
                                        text: 'CPF: ',
                                    },
                                    {
                                        text: arrayDANFE[0][0].inputRegistro
                                    },
                                    {
                                        text: ' - '
                                    },
                                    {
                                        text: arrayDANFE[0][0].inputName
                                    },
                                    {
                                        text: ' - '
                                    },
                                    {
                                        text: arrayDANFE[0][0].inputEndereco
                                    },
                                    {
                                        text: ', '
                                    },
                                    {
                                        text: arrayDANFE[0][0].inputNumero
                                    },
                                    {
                                        text: ', '
                                    },
                                    {
                                        text: arrayDANFE[0][0].inputBairro
                                    },
                                    {
                                        text: ', '
                                    },
                                    {
                                        text: arrayDANFE[0][0].inputMunicipio
                                    },
                                    {
                                        text: ' - '
                                    },
                                    {
                                        text: arrayDANFE[0][0].inputUF
                                    },
                                ], 
                            },
                            {
                                width: '*',
                                alignment: 'center', 
                                text:
                                [
                                    {                                            
                                        text: '\NFC-e nº ',
                                        bold: true
                                    },
                                ], 
                            },
                            {
                                width: '*',
                                alignment: 'center',  
                                qr: arrayDANFE[2],
                                fit: 130,
                            },  
                        ]
                    }  
                    pdfMake.createPdf(docDefinition).download();
                    //console.log(arrayDANFE[0]);
                });
});
  </script>
</body>
</html>