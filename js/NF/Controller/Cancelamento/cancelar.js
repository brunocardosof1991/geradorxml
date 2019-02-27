import {easyPieChart} from '../easyPieChart.js';
import {confirmXMLExist} from '../confirmXMLExist.js';
export const cancelarNF = $(document).on('click', '#cancelarNF', function () {
    let chave = $(this).closest('tr').children('td:eq(0)').text();
    let protocolo = $(this).closest('tr').children('td:eq(2)').text();
    var $confirm = confirm("Tem certeza que deseja cancelar a NFC-e " + chave);
    if ($confirm === true) {
        let text = 'NFC-e cancelada com sucesso!';
        let urlError = 'http://localhost/geradorXml/App/Controller/UniNFe/Error.php'
        let evento = 'cancelar';
        $("#apiModal").modal('show');
        $("#apiModal .modal-title").text('Cancelamento NFC-e');
        $("#apiModal .modal-body p").text('Enviando XML de Cancelamento pro Sefaz, Isso Pode Levar até 30s').show();
        easyPieChart(text, urlError, evento);
        $.ajax({
            method: 'post',
            url: 'http://localhost/geradorXml/App/Controller/UniNFe/Cancelar/Cancelar.php',
            dataType: 'json',
            data: { chave: chave, protocolo: protocolo }
        }).done(function (data) {
            if (data == '{"Enviado para o Sefaz"}') {
                let urlConfirm = 'http://localhost/geradorXml/App/Controller/UniNFe/Cancelar/Confirmar.php';
                confirmXMLExist(urlConfirm, text);
            }
        });
    }// END Confirm
});// END Cancelar NFCe 