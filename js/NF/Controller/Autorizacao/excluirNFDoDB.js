export const excluirNF = $(document).on('click', '#excluirNF', function () {
    var chave = $(this).closest('tr').children('td:eq(0)').text();
    let $confirm = confirm("Tem certeza que deseja excluir a NFC-e com chave " + chave + " do banco de dados?");
    if ($confirm) {
        $.ajax({
            method: 'delete',
            url: 'http://localhost/geradorXml/App/public/api/nf/delete/'+chave
        }).done(function (data) {
            if (data == '{"success": "NF Deletada"}') {
                alert(chave + ' Foi Deletedo Com Sucesso!!');
                location = location
            }
        });
    }
});