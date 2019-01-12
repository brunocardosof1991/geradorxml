$(document).ready(function () {
    var table = $("#tableListarNF").DataTable({
        responsive: true,
        pagingType: "full_numbers",
        ajax: {
            url: 'http://localhost/geradorXml/App/public/api/nf/',
            method: "get",
            dataSrc: ""
        },
        columns: 
        [
            { data: "id" },
            { data: "chave" },
            { data: "dhEmi" },
            { data: "protocolo" },
            { data: "Excluir" },
            { data: "Cancelar" }
        ],
        columnDefs: 
        [ 
            {
                targets: [-1],
                data: null,
                defaultContent: "<div style='text-align:center'><a class='btn btn-default'><i class='fas fa-ban fa-2x' id='cancelarNF' style='cursor:pointer;color:red' title='Cancelar'></i></a></div>"
            },
            {
                targets: [-2],
                data: null,
                defaultContent: "<div style='text-align:center'><a class='btn btn-default'><i class='fas fa-trash fa-2x' id='excluirNF' style='cursor:pointer;color:red' title='Excluir'></i></a></div>"
            }
        ]
    });
    function getNF() 
    {   
        let chaveDeAcesso = true;
        $.ajax({
            url: "http://localhost/geradorXml/App/public/api/cancelarNFCe/true",
            method: 'post',
            dataType: 'json',
            data: {chaveDeAcesso:chaveDeAcesso}
        }).done(function (data){    
            if(data == 'success')
            {
                $("#apiModal .modal-body p").slideUp(850);
                $("#apiModal .modal-body p").text('NFC-e cancelada e excluida com sucesso!   ').slideDown(850);
                $("#apiModal .modal-body").append('<i class="fas fa-thumbs-up fa-2x " style="color:#0fe206"></i>').slideDown(700);
                $('.chart').data('easyPieChart').update(100).options.barColor = '#0fe206';
                $("#apiModal .modal-footer .action").text('Imprimir NFC-e').show();
                setTimeout( function () {location = location; }, 10000);
            } 
            if(data == 'error')
            {
                setTimeout( function () { getNF(); }, 1500);
            }
        });     
    }
    $(document).on('click', '#excluirNF',function() {       
        var id = $(this).closest('tr').children('td:eq(0)').text();
        var chave = $(this).closest('tr').children('td:eq(1)').text();
        let $confirm = confirm("Tem certeza que deseja excluir a NFC-e "+chave);
        if($confirm)         
        {    
            $.ajax({
                method:'delete',
                url: 'http://localhost/geradorXml/App/public/api/nf/delete/'+id
            }).done(function(data){
                if(data == '{"success": "NF Deletada"}')
                {
                    alert(chave+' Foi Deletedo Com Sucesso!!');   
                }   
                location = location;        
            });          
        }
    });
    $(document).on('click','#cancelarNF',function(){
        let chave = $(this).closest('tr').children('td:eq(1)').text();
        let protocolo = $(this).closest('tr').children('td:eq(3)').text();
        let $confirm = confirm("Tem certeza que deseja cancelar a NFC-e "+chave);
        if($confirm)         
        { 
            $.ajax({
                method:'post',
                url:'http://localhost/geradorXml/App/public/api/cancelarNFCe',
                dataType: 'json',
                data:{chave:chave, protocolo:protocolo}
            }).done(function(data){
                if(data == '{"success": "XML Cancelado"}')
                {
                    $("#apiModal").modal('show');
                    $("#apiModal .modal-title").text('Cancelamento NFC-e');
                    $("#apiModal").on('shown.bs.modal', function() {    
                        $('.chart').easyPieChart({
                            // The color of the curcular bar. You can pass either a css valid color string like rgb, rgba hex or string colors. But you can also pass a function that accepts the current percentage as a value to return a dynamically generated color.
                            barColor: '#e60000',
                            // The color of the track for the bar, false to disable rendering.
                            trackColor: '#f2f2f2',
                            // The color of the scale lines, false to disable rendering.
                            scaleColor: '#dfe0e0',
                            // Defines how the ending of the bar line looks like. Possible values are: butt, round and square.
                            lineCap: 'round',
                            // Width of the bar line in px.
                            lineWidth: 3,
                            // Size of the pie chart in px. It will always be a square.
                            size: 110,
                            // Time in milliseconds for a eased animation of the bar growing, or false to deactivate.
                            animate: 25000,
                            // Callback function that is called at the start of any animation (only if animate is not false).
                            onStart: $.noop,
                            // Callback function that is called at the end of any animation (only if animate is not false).
                            onStop: $.noop
                        });               
                    }); 
                    getNF();
                }
            });
        }// END Confirm
    });// END Cancelar NFCe
    
    $(document).on('click', '#inutilzarNF',function() {
        //Resetar Modal
        $('#apiModal').on('shown.bs.modal', function (e) {
            $(this)
              .find("input,textarea,select")
                 .val('')
                 .end()
              .find("input[type=checkbox], input[type=radio]")
                 .prop("checked", "")
                 .end();
        });
        $("#apiModal .modal-title").text('Inutilizar Números');
        $("#apiModal .modal-body p").hide();
        //Mostrar Modal
        $("#apiModal").modal('show');
        $("#apiModal .modal-footer .action").text('Inutilizar').show(); 
        $("#apiModal .modal-body").append($('#formInutilizar').show());
        $("#apiModal .modal-footer .action").on('click',function(){
            let inicio = $('#inputInicio').val();
            let fim = $('#inputFim').val();
            let just = $('#inputJust').val();
            $.ajax({
                method:'post',
                url: 'http://localhost/geradorXml/App/public/api/inutilizar',
                dataType: 'json',
                data:{inicio:inicio, fim:fim, just:just}
            }).done(function(data){
                console.log(data);
            });
        });
    });
});