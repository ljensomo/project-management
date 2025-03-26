const overviewTable = "#overviewTable";

$(document).ready(function () {
    instantiateDatatable({
        tableId: overviewTable,
        url: "php-functions/project/get-overview.php",
        paging:false,
        info: false,
        columns: [
            {data: "phase"},
            {data: "status", className: "text-center"},
            {data: "progress", className: "text-center"},
        ]
    });
});