$(document).ready(function(){
    $('#modalUsuario').on('shown.bs.modal', function (e) {
        $(this)
          .find("input,textarea,select")
             .val('')
             .end()
          .find("input[type=checkbox], input[type=radio]")
             .prop("checked", "")
             .end();
    }); 
    //Verificar se o usuario é admin/usuario
    let status = true;
    $.ajax({
        method:'get',
        url: 'http://localhost/geradorXml/App/public/api/usuario/status',
        dataType:'json',
        data:{status}
    }).done(function(data){
        if(data !== 'admin')
        {$("#navbarCadastrarUsuario").hide();} 
        if(data === 'admin') 
        {$("#navbarCadastrarUsuario").show();}
    });
    $(".addUsuario").click(function(){
        let usuario = $("#inputUsuario").val();
        let email = $("#inputEmail2").val();
        let senha = $("#inputSenha").val();
        let status = $("#status").val();
        $.ajax({
            method:'post',
            url: 'http://localhost/geradorXml/App/public/api/usuario/add',
            dataType:'json',
            data:{usuario:usuario, email:email, senha:senha, status:status}
        }).done(function(data){
            console.log(data);
            alert('Usuario Cadastrado')
            $(".modal").modal('hide');
        });
    });
});