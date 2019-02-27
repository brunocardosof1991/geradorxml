export const cancDatatable = $("#tableListarNFCancelada").DataTable({
    responsive: true,
    pagingType: "full_numbers",
    ajax: {
        url: 'http://localhost/geradorXml/App/public/api/nf/cancelada',
        method: "get",
        dataSrc: ""
    },
    columns: 
    [
        { 
            data: "nf",
            "render": function(data, type, row, meta){
               if(type === 'display'){
                   data = '<a href="' + data + '"target="_blank"> <button class="btn btn-info">NFC-e</button></a>'
               }                   
               return data;
            } 
        },
        { data: "data" }
        /* { data: "Imprimir" },
        { data: "Compartilhar" } */
    ],
    columnDefs: 
    [ 
        {
            targets: [-1],
            data: null,
            defaultContent: "<div style='text-align:center'><a class='btn btn-default'><i class='fas fa-share-alt fa-2x' id='compartilharrNF' style='cursor:pointer' title='Compartilhar'></i></a></div>"
        },
        {
            targets: [-2],
            data: null,
            defaultContent: "<div style='text-align:center'><a class='btn btn-default'><i class='fas fa-print fa-2x' id='imprimirNF' style='cursor:pointer' title='Imprimir'></i></a></div>"
        }
    ]
});