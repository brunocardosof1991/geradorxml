$(document).ready(function(){
    //Verificar se existe chaveDeAcesso.txt
    let verify = true;
    $.ajax({
        method:'post',
        url:'http://localhost/geradorxml/app/public/api/verifyFiles',
        dataType:'json',
        data:{verify:verify}
    });
    //Validação
});