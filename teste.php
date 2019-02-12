
<script src="pdfmake-master/build/pdfmake.js"></script>
<script src="pdfmake-master/build/vfs_fonts.js"></script>
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
  $(document).ready(function(){
        let DANFE = true;
                $.ajax({
                    method: 'get',
                    url: 'http://localhost/geradorXml/App/public/api/DANFE',
                    dataType: 'json',
                    data:{DANFE:DANFE}
                }).done(function(data){
                // Object of object to array of object
                var arrayDANFE = Object.keys(data).map(key => data[key]);
                console.log(arrayDANFE);
                function buildTableBody(data, columns) {
                    var body = [];
                    body.push(columns);
                    data.forEach(function(row) {
                        var dataRow = [];
                        columns.forEach(function(column) {
                            dataRow.push(row[column].toString());
                        })
                        body.push(dataRow);
                    });
                    return body;
                }
                function table(data, columns) {
                    return {
                        table: {
                            headerRows: 1,
                            body: buildTableBody(data, columns)                        },
                        layout: 'noBorders'
                    };
                }
                function desconto()
                {
                    if(typeof arrayDANFE[0][0].inputDesconto !== 'undefined')
                    {
                        return {
                            
                            columns:
                            [
                                {
                                    alignment: 'left',
                                    text: 'Desconto R$'
                                },
                                {
                                    alignment: 'right',
                                    text: arrayDANFE[0][0].inputDesconto
                                },
                            ]

                        };
                    } 
                    if(typeof arrayDANFE[0][0].inputDesconto === 'undefined') 
                    {
                        return {
                            
                            columns:
                            [
                                {
                                    alignment: 'left',
                                    text: 'Desconto R$'
                                },
                                {
                                    alignment: 'right',
                                    text: 'Sem Desconto'
                                },
                            ]
                        };
                        
                    }
                }
                //Valor a Pagar Com && Sem desconto
                function valorTotal()
                {
                    if(typeof arrayDANFE[0][0].inputDesconto !== 'undefined')
                    {                        
                        return{
                            columns:
                            [
                                {          
                                    alignment: 'left',                              
                                    text: 'Valor a Pagar R$',
                                    bold: true
                                },
                                {        
                                    alignment: 'right',                              
                                    text: parseFloat((arrayDANFE[0][3] - arrayDANFE[0][0].inputDesconto).toFixed(2)),
                                    bold: true
                                },
                            ]    
                        };
                    } 
                    if(typeof arrayDANFE[0][0].inputDesconto === 'undefined')  
                    {                    
                        return{
                            columns:
                            [
                                {          
                                    alignment: 'left',                              
                                    text: 'Valor a Pagar R$',
                                    bold: true
                                },
                                {        
                                    alignment: 'right',                              
                                    text: arrayDANFE[0][3],
                                    bold: true
                                },
                            ]    
                        };                       
                    }
                }
                //Consumidor identificado && S/ Desconto
                if(typeof arrayDANFE[0][0].inputName === 'string')
                {
                    var dd = {
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
                            table(arrayDANFE[1], ['Codigo', 'Descricao','Qtd','UN','Vl Unit','Vl Total']),                        
                            {
                                    columns:[
                                        {
                                            alignment: 'left',
                                            text: '\nQtde. total de itens'
                                        },
                                        {
                                            alignment: 'right',
                                            text: '\n'+arrayDANFE[0][6]
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
                                            text: arrayDANFE[0][3]
                                        }
                                    ]
                                },
                                desconto(),
                                valorTotal(),  
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
                                            text: '\nNFC-e nº ',
                                            bold: true
                                        },
                                        {                                            
                                            text: arrayDANFE[3],
                                            bold: true
                                        },
                                        {                                            
                                            text: '    Série ',
                                            bold: true
                                        },
                                        {                                            
                                            text: '00'+arrayDANFE[6],
                                            bold: true
                                        },
                                        {                                            
                                            text: '    '+arrayDANFE[5],
                                            bold: true
                                        },
                                    ]
                                },
                                {
                                    text: '\nProtocolo de Autorização: '+arrayDANFE[4],
                                    alignment: 'center'
                                },
                                {
                                    text: '\nData da Autorização: '+arrayDANFE[5],
                                    alignment: 'center'
                                },
                                {
                                    text: '\n',
                                    alignment: 'center'
                                },
                                {
                                    width: '*',
                                    alignment: 'center',  
                                    qr: arrayDANFE[2],
                                    fit: 150,
                                },      
                        ]
                    }
                }
                // Consumidor Não identificado
                if(typeof arrayDANFE[0][0].inputName === 'undefined')
                {
                    var dd = {
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
                            table(arrayDANFE[1], ['Codigo', 'Descricao','Qtd','UN','Vl Unit','Vl Total']),                        
                            {
                                    columns:[
                                        {
                                            alignment: 'left',
                                            text: '\nQtde. total de itens'
                                        },
                                        {
                                            alignment: 'right',
                                            text: '\n'+arrayDANFE[0][6]
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
                                            text: arrayDANFE[0][3]
                                        }
                                    ]
                                },                                
                                desconto(),
                                valorTotal(),    
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
                                            text: '\nCONSUMIDOR NÃO IDENTIFICADO',
                                            bold: true
                                        }
                                    ], 
                                },
                                {
                                    width: '*',
                                    alignment: 'center', 
                                    text:
                                    [
                                        {                                            
                                            text: '\nNFC-e nº ',
                                            bold: true
                                        },
                                        {                                            
                                            text: arrayDANFE[3],
                                            bold: true
                                        },
                                        {                                            
                                            text: '    Série ',
                                            bold: true
                                        },
                                        {                                            
                                            text: '00'+arrayDANFE[6],
                                            bold: true
                                        },
                                        {                                            
                                            text: '    '+arrayDANFE[5],
                                            bold: true
                                        },
                                    ]
                                },
                                {
                                    text: '\nProtocolo de Autorização: '+arrayDANFE[4],
                                    alignment: 'center'
                                },
                                {
                                    text: '\nData da Autorização: '+arrayDANFE[5],
                                    alignment: 'center'
                                },
                                {
                                    text: '\n',
                                    alignment: 'center'
                                },
                                {
                                    width: '*',
                                    alignment: 'center',  
                                    qr: arrayDANFE[2],
                                    fit: 150,
                                },      
                        ]
                    }

                }
                pdfMake.createPdf(dd).download();
                });
});
  </script>
</body>
</html>