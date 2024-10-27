const techTable = "#techTable";
const techForm = "#techForm";
const techModal = "#techModal";

$(document).ready(function(){

    // instantiate datatable
    $(techTable).DataTable({
        lengthChange: false,

    });

    // add button in datatable
    let add_icon = "<i class='fa fa-plus'></i>";
    let add_button = "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#techModal'>"+add_icon+" Add Technology</button>";
    $("#techTable_wrapper").prepend(add_button);
});