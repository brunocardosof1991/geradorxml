$(document).ready(function(){
    //Validar Email - Verificar se existe no banco de dados
    $("#inputEmail").focusout(function(){
        let email = $(this).val();
        $.ajax({
            method:'post',
            url:'http://localhost/geradorXml/App/Controller/Login/Validate/Email.php',
            dataType:'json',
            data:{email:email}
        }).done(function(data){
            if(data.length !== 0)
            {$('#inputEmail').css("border", "3px solid green");}
            if(data.length === 0)
            {$('#inputEmail').css("border", "3px solid red");}
        });
    });
    //Validar Senha - Verificar se existe no banco de dados
    $("#inputPassword").focusout(function(){
        let senha = $(this).val();
        $.ajax({
            method:'post',
            url:'http://localhost/geradorXml/App/Controller/Login/Validate/Senha.php',
            dataType:'json',
            data:{senha:senha}
        }).done(function(data){
            if(data.length !== 0)
            {$('#inputPassword').css("border", "3px solid green")}
            if(data.length === 0)
            {$('#inputPassword').css("border", "3px solid red")}
        });
    });
    //Logar
    $("#btnLogar").on('click',function(event){
        let email = $("#inputEmail").val();
        let senha = $("#inputPassword").val();
        $.ajax({
            method:'post',
            url:'http://localhost/geradorXml/App/Controller/Login/Logar.php',
            dataType:'json',
            data:{email:email, senha:senha}
        }).done(function(data){
            window.location.replace("http://localhost/geradorXml");  
        });
    });
});