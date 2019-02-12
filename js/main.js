$(document).ready(function(){
    //Deletar Arquivos Temporários
    let deleteFile = true
    $.ajax({
        method:'get',
        url:'http://localhost/geradorxml/App/Controller/DeleteFiles.php',
        dataType: 'json',
        data:{deleteFile:deleteFile}
    });
});