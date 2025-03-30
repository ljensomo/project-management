import axios from "axios";
import Swal from "sweetalert2";
import $ from "jquery";
import { DataTable } from "simple-datatables";

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

  parameters.forEach(async function (parameter) {
    try {
      const response = await axios.get(parameter.url);
      const data = response.data.data;

      const tableData = data.map((row) => {
        return parameter.columns.map((col) => row[col.data]);
      });

      const table = document.querySelector(parameter.tableId);
      const dataTable = new DataTable(table, {
        data: {
          data: tableData,
        },
        searchable: true,
        sortable: true,
      });

      applyTableDesign(table);
    } catch (error) {
      console.error(error);
    }
  });
}

function applyTableDesign(tableElement) {
  const cells = tableElement.querySelectorAll("td");
  cells.forEach((cell) => {
    cell.classList.add("dark:text-white");
  });
}

export function observeTableRendering(tableId, callback) {
  const tableElement = document.querySelector(tableId);

  if (!tableElement) {
    console.error(`Table with ID ${tableId} not found.`);
    return;
  }

  const observer = new MutationObserver((mutations, observerInstance) => {
    const rows = tableElement.querySelectorAll("tbody tr");
    if (rows.length > 0) {
      callback();
      observerInstance.disconnect();
    }
  });

  observer.observe(tableElement, { childList: true, subtree: true });
}
