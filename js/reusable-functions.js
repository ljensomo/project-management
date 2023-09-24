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

function populateSelect(parameters){

    ajaxGet({
        url: parameters.url,
        errorMessage: !parameters.errorMessage ? "Something went wrong." : parameters.errorMessage,
        callback: function(response){
            let x = 0;
            $.each(response.data, function(){
                let value = response.data[x][parameters.value];
                let text = parameters.text;

                if(Array.isArray(text)){
                    text = "";
                    for(let textValue of parameters.text){
                        text += response.data[x][textValue]+" ";
                    }
                }else{
                    text = response.data[x][parameters.text];
                }

                if(Array.isArray(parameters.selectId)){
                    for(var i in parameters.selectId){
                        $("#"+parameters.selectId[i]).append($("<option />").val(value).text(text));
                    }
                }else{
                    $("#"+parameters.selectId).append($("<option />").val(value).text(text));
                }

                x++;
            });
        }
    });
}

function clearSelect2(selectId){
    $("#"+selectId).val("").trigger("change");
}

function deleteRecord(parameters){

    ajaxChecker(parameters);

    Swal.fire({
        title: !parameters.title ? "Delete?" : parameters.title,
        text: !parameters.text ? "Do you want to delete "+parameters.subject+"?" : parameters.text,
        icon: "question",
        showCancelButton: true,
        confirmButtonText: !parameters.confirmButtonText ? "Confirm Delete" : parameters.confirmButtonText,
    }).then((result) => {
        if(result.isConfirmed){
            $.ajax({
                url: parameters.url,
                data: parameters.data,
                method: "POST",
                dataType: "json"
            }).done(function(response){
                if(response.success){
                    swalSuccess({
                        title: "Removed!",
                        text: "Successfully removed "+parameters.subject+".",
                        callback: parameters.callback
                    });

                    return;
                }

                swalError(response.message);
            }).fail(function(response){
                console.log(response);
                swalError(!parameters.errorMessage ? "Something went wrong!" : parameters.errorMessage);
            });
        }
    });
}

function generateTableRowButtons(parameters){
    let buttons = "";

    if(parameters.view){
        buttons += "<a href='"+parameters.viewUrl+"' class='btn btn-sm btn-info'>View More</a> ";
    }

    if(parameters.edit){
        buttons += "<button type='button' class='btn btn-sm btn-warning btn-"+parameters.buttonFor+"-edit' ";
        buttons += "data-id='"+parameters.rowId+"' data-value='"+parameters.rowValue+"'>Edit</button> ";
    }

    if(parameters.delete){
        buttons += "<button type='button' class='btn btn-sm btn-danger btn-"+parameters.buttonFor+"-delete' ";
        buttons += "data-id='"+parameters.rowId+"' data-value='"+parameters.rowValue+"'>Delete</button>";
    }

    return buttons;
}