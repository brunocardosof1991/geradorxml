export const visualizarNF = $(document).one('click', '#visualizarNF', function (event) {
    var chave = $(this).closest('tr').children('td:eq(0)').text();
    $.ajax({
        method: 'get',
        url: 'http://localhost/geradorXml/App/Controller/UniNFe/QRCode.php',
        dataType: 'json',
        data: { chave: chave }
    }).done(function (data) {
        $("#modalQR").modal('show');
        $("#accessNFCe").attr("href", data);
        $('#qrcode').qrcode(data);
    });
    $(document).click('#btnFechar',() => {
        location = location;
    });
});