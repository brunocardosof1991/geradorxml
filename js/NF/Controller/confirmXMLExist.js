import {saveXMLInDB} from './saveXMLInDB.js';
export function confirmXMLExist(urlConfirm,text) 
    {   
        let chaveDeAcesso = true;
        $.ajax({
            url: urlConfirm,
            method: 'post',
            dataType: 'json',
            data: {chaveDeAcesso:chaveDeAcesso}
        }).done(function (data){    
            if(data == 'success')
            {
                $("#apiModal .modal-body p").slideUp(850);
                $("#apiModal .modal-body p").text(text).slideDown(850);
                $("#apiModal .modal-body").append('<i class="fas fa-thumbs-up fa-2x " style="color:#0fe206"></i>').slideDown(700);
                $('.chart').data('easyPieChart').update(100).options.barColor = '#0fe206';
                let urlSaveInDB;
                if(urlConfirm.match(/Cancelar/))
                {
                    urlSaveInDB = 'http://localhost/geradorXml/App/Controller/UniNFe/Cancelar/Salvar.php';
                }
                if(urlConfirm.match(/Inutilizar/))
                {
                    urlSaveInDB = 'http://localhost/geradorXml/App/Controller/UniNFe/Inutilizar/Salvar.php';
                }
                saveXMLInDB(urlSaveInDB);
            } 
            if(data == 'error')
            {
                setTimeout( function () { confirmXMLExist(urlConfirm,text); }, 1500);
            }
        });     
    }