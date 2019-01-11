<!DOCTYPE html>
<html>
    <head> 
        <!-- ======================== META TAGS OBRIGATÓRIAS ================================================== -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">       

        <!-- JQUERY-->
        <script src="../js/external/jquery/jquery.js"></script>       
        <script src="main.js"></script>       

        <!-- Folha de estilo da página -->
        <link href="../css/style.css" type="text/css" rel="stylesheet">

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <!-- ================================================================================================ -->
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <!-- ======================== LINK BOOTSTRAP CSS 4.1 ================================================== -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <!-- ================================================================================================== -->
       
    </head>
    <body>    
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <form id="formCappta">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Forma de Pagamento</label>
                        <select id="payment" name="payment" class="form-control" id="exampleFormControlSelect1">
                            <option value="">...</option>
                            <option value="01">Dinheiro</option>
                            <option value="02">Cheque</option>
                            <option value="03">Cartão de Crédito</option>
                            <option value="04">Cartão de Débito</option>
                            <option value="05">Crédito Loja</option>
                            <option value="10">Vale Alimentção</option>  
                            <option value="11">Vale Refeição</option>
                            <option value="12">Vale Presente</option>
                            <option value="13">Vale Combustível</option>
                            <option value="99">Outros</option>
                        </select>
                    </div>                    
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Preço</label>
                        <input type="number" class="form-control inputPreco" id="exampleFormControlInput1" placeholder="...">
                    </div>
                    </div>                    
                    <div class="form-group mx-auto">
                        <input type="button" class="btn btn-success ok" value="ok">
                    </div>
                </form>   
                </div>
            </div>
        </div>
    </body>
</html>