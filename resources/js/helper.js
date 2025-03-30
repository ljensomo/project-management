import axios from "axios";
import Swal from "sweetalert2";
import $ from "jquery";

function axiosChecker(parameters) {
  if (!parameters) throw new Error("Properties not set.");
  if (!parameters) throw new Error("URL not set.");
  if (!parameters) throw new Error("Callback function not set.");
}

export function axiosGet(parameters) {
  axiosChecker(parameters);

  axios
    .get(parameters.url)
    .then((response) => parameters.callback(response))
    .catch((error) => {
      console.error(error);
      parameters.errorMessage != undefined
        ? swalError(parameters.errorMessage)
        : swalError();
    });
}

export function axiosPost(parameters) {
  axiosChecker(parameters);

  axios
    .post(parameters.url, parameters.formData)
    .then((response) => {
      parameters.callback(response.data);
    })
    .catch((error) => {
      console.error(error);
      parameters.errorMessage != undefined
        ? swalError(parameters.errorMessage)
        : swalError();
    });
}

export function swalSuccess(parameters) {
  Swal.fire({
    title: parameters.title,
    text: parameters.text,
    icon: "success",
  }).then((result) => {
    if (parameters.callback) {
      parameters.callback(result);
    }
  });
}

export function swalError(message = "Something went wrong!", title = null) {
  Swal.fire({
    title: title != null ? title : "Ooops!",
    text: message,
    icon: "error",
  });
}

export function instantiateDatatable(parameters) {
  if (!Array.isArray(parameters)) {
    parameters = [parameters];
  }

  parameters.forEach(function (parameter) {
    $(parameter.tableId).DataTable({
      paging: parameter.paging !== undefined ? parameter.paging : true,
      searching:
        parameter.searching !== undefined ? parameter.searching : false,
      info: parameter.info !== undefined ? parameter.info : true,
      lengthChange: parameter.lengthChange ? parameter.lengthChange : false,
      ajax: {
        url: parameter.url,
        dataSrc: "data",
      },
      columns: parameter.columns,
      ordering: false,
    });
  });
}
