$(document).ready(function () {
    function selecionarNF() {
        let chave = ($(this).closest('tr').children(":first").text());
        $confirm = confirm("Nota com a chave de acesso "+chave+".\nTem certeza que deseja cancelar?");
        if($confirm)         
        {
            $.ajax({
                type: 'post',
                url: 'http://localhost/erpsys/App/Controller/api.php',
                dataType: 'json',
                data: {
                    cancelarNF:chave
                }
            });            
        }
    }
    $.ajax({
        type: 'get',
        url: 'http://localhost/geradorXml/public/api/clients',
        dataType: 'json'
    }).done((data) => {
        console.log(data);
        if(data !== '') 
        {
            $.each(data, (index,value) => {
                if(data) 
                {
                    var tr = 
                    $('<tr>').append(
                        $('<td>').text(value.chave),
                        $('<td>').text(value.dhEmi),
                        $('<td>').text(value.CNPJDestinatario),
                        $('<td>').text(value.xNomeDestinatario),
                        $('<td>').text('Protocolo'),
                        $('<td>').append('<i class="far fa-hand-pointer fa-2x"></i>').css({'cursor':'pointer', 'color':'#00b33c'}).click(selecionarNF)
                    ).appendTo("#tableListarNF").html();
                }
            });
        }
    });
});