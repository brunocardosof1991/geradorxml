export const inuDatatable = $("#tableListarInutilizacao").DataTable({
    responsive: true,
    pagingType: "full_numbers",
    ajax: {
        url: 'http://localhost/geradorXml/App/public/api/nf/inutilizado',
        method: "get",
        dataSrc: ""
    },
    columns: 
    [
        { data: "inicio" },
        { data: "fim" },
        { data: "data" }
    ]
});