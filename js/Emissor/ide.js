$(document).ready(function(){
    $(".tpEmis").on('change',function(){
        let selected = $(this).find(":selected").val();
        if(selected === '4' || selected === '9' )
        {
            $(".dhCont").show();
            let timestamp = true;
            $.ajax({
                method:'post',
                url:'http://localhost/geradorXml/App/public/api/timestamp',
                dataType:'json',
                data:{timestamp:timestamp}
            }).done(function(data){
                $("#divdhCont").show();
                $("#divxJust").show();
                $(".dhCont").val(data);
            });
        }
        if(selected !== '4' || selected !== '9' )
        {
            $("#divdhCont").hide();
            $("#divxJust").hide();
        }
    });
    //Startar os selects com a Identificação da NFC-e salva no banco de dados
    fetchAll();
    var ideConfig = [];
    function fetchAll(){
    let ajax = $.ajax({
        method:'get',
        url:'http://localhost/geradorXml/App/public/api/emissor/ide/get',
        dataType: 'json',
        }).done(function(data){
            if(data.length === 1)
            {
                $(".cUF").val(data[0].cUF);
                $(".natOp").val(data[0].natOp);
                $(".modelo").val(data[0].modelo);
                $(".serie").val(data[0].serie);
                $(".tpNF").val(data[0].tpNF);
                $(".idDest").val(data[0].idDest);
                $(".cMunFG").val(data[0].cMunFG);
                $(".tpImp").val(data[0].tpImp);
                $(".tpEmis").val(data[0].tpEmis);
                $(".tpAmb").val(data[0].tpAmb);
                $(".finNFe").val(data[0].finNFe);
                $(".indFinal").val(data[0].indFinal);
                $(".indPres").val(data[0].indPres);
                $(".procEmi").val(data[0].procEmi);
                ideConfig = ajax.responseJSON;
                $("#salvarConfig").hide();
            }
            if(data.length === 0)
            {$("#ediarConfig").hide();}
        });        
    }
    //Adicionar Identificação da NFC-e no banco de dados
    $(document).on('click','#salvarConfig',function(event){      
        let cUF = $(".cUF").val();
        let natOp = $(".natOp").val();
        let modelo = $(".modelo").val();
        let serie = $(".serie").val();
        let tpNF = $(".tpNF").val();
        let idDest = $(".idDest").val();
        let cMunFG = $(".cMunFG").val();
        let tpImp = $(".tpImp").val();
        let tpEmis = $(".tpEmis").val();
        let tpAmb = $(".tpAmb").val();
        let finNFe = $(".finNFe").val();
        let indFinal = $(".indFinal").val();
        let indPres = $(".indPres").val();
        let procEmi = $(".procEmi").val(); 
            $.ajax({
                method:'post',
                url:'http://localhost/geradorXml/App/public/api/emissor/ide/add',
                dataType: 'json',
                data: {cUF:cUF, natOp:natOp, modelo:modelo, serie:serie, tpNF:tpNF, idDest:idDest, cMunFG:cMunFG, tpImp:tpImp, tpEmis:tpEmis, tpAmb:tpAmb, 
                    finNFe:finNFe, indFinal:indFinal, indPres:indPres, procEmi:procEmi}
            }).done(function(data){
                if(data === 'Success')
                {alert("Identificação Adicionada com Sucesso")};
                location = location;
            });
    });
    //Editar Identificação da NFC-e no banco de dados
    $(document).on('click','#ediarConfig',function(event){      
        let cUF = $(".cUF").val();
        let natOp = $(".natOp").val();
        let modelo = $(".modelo").val();
        let serie = $(".serie").val();
        let tpNF = $(".tpNF").val();
        let idDest = $(".idDest").val();
        let cMunFG = $(".cMunFG").val();
        let tpImp = $(".tpImp").val();
        let tpEmis = $(".tpEmis").val();
        let tpAmb = $(".tpAmb").val();
        let finNFe = $(".finNFe").val();
        let indFinal = $(".indFinal").val();
        let indPres = $(".indPres").val();
        let procEmi = $(".procEmi").val();
            $.ajax({
                method:'put',
                url:'http://localhost/geradorXml/App/public/api/emissor/ide/update/'+cUF,
                dataType: 'json',
                data: {cUF:cUF, natOp:natOp, modelo:modelo, serie:serie, tpNF:tpNF, idDest:idDest, cMunFG:cMunFG, tpImp:tpImp, tpEmis:tpEmis, tpAmb:tpAmb, 
                    finNFe:finNFe, indFinal:indFinal, indPres:indPres, procEmi:procEmi}
            }).done(function(data){
                alert('Identificação Atualizada');
                location = location;
            });
    });
});