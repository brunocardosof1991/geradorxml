import {easyPieChart} from '../easyPieChart.js';
import {confirmXMLExist} from '../confirmXMLExist.js';
import {isValidInicio, validateInicioField} from './validation.js';
import {isValidFim, validateFimField} from './validation.js';
import {isValidJust, validateJustField} from './validation.js';
export const inutilizarNumeracao = $(document).on('click', '#inutilizarNumeracao', function (event) {
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
    let inicio = $('#inputInicio').val();
    let fim = $('#inputFim').val();
    let just = $('#inputJust').val();
    validateInicioField(inicio, event);
    validateFimField(fim, event);
    validateJustField(just, event);
    if (isValidInicio(inicio) !== false && isValidFim(fim) !== false && isValidJust(just) !== false) {
        $.ajax({
            method: 'post',
            url: 'http://localhost/geradorXml/App/Controller/UniNFe/Inutilizar/Inutilizar.php',
            dataType: 'json',
            data: { inicio: inicio, fim: fim, just: just }
        }).done(function (data) {
            if (data == '{"Enviado para o Sefaz"}')
            {
                let text = 'Numeração Inutilizada com sucesso!';
                let urlError = 'http://localhost/geradorXml/App/Controller/UniNFe/Error.php'
                let urlConfirm = 'http://localhost/geradorXml/App/Controller/UniNFe/Inutilizar/Confirmar.php';
                let evento = 'inutilizar';
                $("#apiModal").modal('show');
                $("#apiModal .modal-body p").text('Enviando XML de inutilização pro Sefaz, isso pode levar até 30s').show();
                $("#apiModal .modal-title").text('Inutilização de Numeração');
                easyPieChart(text, urlError, evento);
                confirmXMLExist(urlConfirm, text);
            }
        });
    }//END Validation Inutilizar
});
$('#btnFechar').on('click',() =>{ location = location });