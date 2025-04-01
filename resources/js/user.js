import $ from "jquery";
import {
  instantiateDatatable, generateTableRowButtons, axiosPost,
  swalSuccess, swalError, refreshDatatable
} from "./helper"

const tableId = "#user-table";
const formId = "#user-form";
const modalId = "#user-modal";


// initialize datatable
instantiateDatatable([
  {
    tableId: tableId,
    url: "/users",
    columns: [
      { data: "id"},
      { data: function(data){
        return data.first_name + " " + data.last_name;
      } },
      { data: "email" },
      { data: "username" },
      { data: function(data){
        switch(data.role_id) {
          case "1":
          case 1:
            return '<span class="badge badge-danger">Admin</span>';
          case "2":
          case 2:
            return '<span class="badge badge-primary">User</span>';
          default:
            return '<span class="badge badge-secondary">Unknown</span>';
        }
      } },
      { 
        data: function(data){
          return data.is_active == 1 
            ? '<span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Active</span>' 
            : '<span class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">Inactive</span>';
        } 
      },
      { data: "date_created" },
      {
        data: function (row) {
          return generateTableRowButtons({
            edit: true,
            delete: true,
          });
        },
      },
    ],
  },
]);

// form submit handler
$(formId).on("submit", function (e) {
  e.preventDefault();

  axiosPost({
    url: "/users/add",
    formData: new FormData(this),
    errorMessage: "Failed to create user.",
    callback: function (response) {
      if (response.success) {
        swalSuccess({
          title: "User Created",
          text: response.message,
          callback: function () {
            $(formId)[0].reset();
            refreshDatatable(tableId);
          },
        });
        return;
      }

      swalError(response.message, "User Creation Error");
    },
  });
});