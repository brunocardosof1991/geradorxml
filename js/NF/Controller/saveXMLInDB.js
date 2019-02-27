export function saveXMLInDB(url)
{
    let commit = 'commit';
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: { commit: commit }
    }).done(function (data) {
        if (data === "success") {
            alert('XML salvo no Banco de Dados')
        }
        if (data === "error") {
            alert('Ocorreu um erro para salvar o XML')
        }
    });
}