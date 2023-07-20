function sweetAlert(swal, callback = null){
    Swal.fire({
        'title': swal.title != undefined ? swal.title : 'Done',
        'text': swal.message,
        'icon': swal.icon != undefined ? swal.icon : 'success'
    }).then((result) => {
        if(callback){
            callback(result);
        }
    });
}

function refreshDatatable(tableId){
    $(tableId).DataTable().ajax.reload(null, false);
}