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

function swalSuccess(parameters){
    Swal.fire({
        'title': parameters.title,
        'text': parameters.text,
        'icon': 'success'
    }).then((result) => {
        if(parameters.callback){
            parameters.callback(result);
        }
    });
}


function swalError(message = "Something went wrong!"){
    Swal.fire({
        "title": "Ooops!",
        "text": message,
        "icon": "error"
    });
}

function refreshDatatable(tableId){
    $(tableId).DataTable().ajax.reload(null, false);
}

function ajaxGet(parameters){

    ajaxChecker(parameters);

    $.ajax({
        "url": parameters.url,
        "method": "GET",
        "dataType": "json"
    }).done(function(response){
        parameters.callback(response);
    }).fail(function(response){
        console.log(response);
        parameters.errorMessage != undefined ? swalError(parameters.errorMessage) : swalError();
    });
}

function ajaxPost(parameters){

    ajaxChecker(parameters);

    $.ajax({
        "url": parameters.url,
        "method": "POST",
        "data": parameters.formData,
        "processData": false,
        "contentType": false,
        "dataType": "json"
    }).done(function(response){
        parameters.callback(response);
    }).fail(function(response){
        console.log(response);
        parameters.errorMessage != undefined ? swalError(parameters.errorMessage) : swalError();
    });
}

function ajaxChecker(parameters){
    if(!parameters){
        throw "Properties not set.";
    }

    if(!parameters.url){
        throw "AJAX url not set."
    }

    if(!parameters.callback){
        throw "callback function not set.";
    }
}