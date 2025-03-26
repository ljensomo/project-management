const table = "#databaseTable";
const url = {
    tableData: "php-functions/get-database-backups.php",
    generate: "php-functions/database-dump.php"
}

$(document).ready(function(){

    // instantiate functions table
    $("#databaseTable").DataTable({
        pagination: false,
        ajax: {
            url: url.tableData,
            dataSrc: "data"
        },
        columns: [
            {data: function(data){
                let filename = data.filename;
                return "<a href='database/"+filename+"'>"+filename+"</a>";
            }},
            {data: "date_created"},
            {data: "created_by_name"},
            {data: function(data){
                return generateTableRowButtons({
                    buttonFor: "backup",
                    rowId: data.id,
                    rowValue: data.filename,
                    delete: true
                });
            }, className: "text-center"}
        ]
    });

    $(".btnGenerate").click(function(){
        ajaxPost({
            url: url.generate,
            formData:[],
            errorMessage: "Failed to generate backup.",
            callback:function(response){
                if(response.success){
                    swalSuccess({
                        title: "Generated!",
                        text: response.message,
                        callback: function(){
                            refreshDatatable(table);
                        }
                    });
                }else{
                    swalError(response.message);
                }
            }
        });
    });

    createDeleteButtonListener({
        class: 'btn-backup-delete',
        url: 'php-functions/delete-backup.php',
        tableId: table
    });
});