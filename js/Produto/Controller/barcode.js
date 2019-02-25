
export const preventDefaultBarCode = $("#inputcEANProduto").keypress(function (event) {
    if (event.which == '10' || event.which == '13') {event.preventDefault();}
});