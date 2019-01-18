$(document).ready(function(){
    $(document).on('click','#salvarConfig',function(e){ 
		e.preventDefault();       
        var ide = $('select.form-control').map(function(){
            return this.value
        }).get();
        let cUF = ide[0];
        let natOp = ide[1];
        let mod = ide[2];
        let serie = ide[3];
        let tpNF = ide[4];
        let idDest = ide[5];
        let cMunFG = ide[6];
        let tpImp = ide[7];
        let tpEmis = ide[8];
        let tpAmb = ide[9];
        let finNFe = ide[10];
        let indFinal = ide[11];
        let indPres = ide[12];
        let procEmi = ide[13];
    $.ajax({
        method:'post',
        url:'http://localhost/geradorXml/App/public/api/emissor/ide',
        dataType: 'json',
        data: {cUF:cUF, natOp:natOp, mod:mod, serie:serie, tpNF:tpNF, idDest:idDest, cMunFG:cMunFG, tpImp:tpImp, tpEmis:tpEmis, tpAmb:tpAmb, 
            finNFe:finNFe, indFinal:indFinal, indPres:indPres, procEmi:procEmi}
        }).done(function(data){
            console.log(data);
        });
    });
});