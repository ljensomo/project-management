import { Grid, html } from "gridjs";
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

// export function instantiateDatatable(parameters) {
//   if (!Array.isArray(parameters)) {
//     parameters = [parameters];
//   }

//   parameters.forEach(async function (parameter) {
//     try {
//       const response = await axios.get(parameter.url);
//       const data = response.data.data;

//       const tableData = data.map((row) => {
//         return parameter.columns.map((col) => {
//           if (typeof col.data === "function") {
//             return html(col.data(row));
//           }
//           return row[col.data];
//         });
//       });

//       new Grid({
//         columns: parameter.columns.map((col) => ({
//           name: col.title || col.data, // Set column titles
//           formatter:
//             typeof col.data === "function"
//               ? (_, row) => html(col.data(row))
//               : undefined, // Handle custom HTML rendering
//         })),
//         data: tableData,
//         search: true,
//         sort: true,
//         pagination: {
//           enabled: true,
//           limit: parameter.paginationLimit || 5,
//         },
//       }).render(document.querySelector(parameter.tableId));
//     } catch (error) {
//       console.error(error);
//     }
//   });
// }

export function instantiateDatatable(parameters) {
  if (!Array.isArray(parameters)) {
    parameters = [parameters];
  }

  parameters.forEach(async function (parameter) {
    try {
      const response = await axios.get(parameter.url);
      const data = response.data.data;

      const tableData = data.map((row) => {
        return parameter.columns.map((col) => {
          // Handle column data transformations
          if (typeof col.data === "function") {
            return html(col.data(row)); // Use the transformed value
          }
          return row[col.data] || "N/A"; // Fallback for missing properties
        });
      });

      // Configure Grid.js without complex internal transformations
      new Grid({
        columns: parameter.columns.map((col) => ({
          name: col.title || col.data, // Simplify column definitions
          sort: col.sort !== undefined ? col.sort : true,
        })),
        data: tableData, // Pass preprocessed data directly
        search: true,
        pagination: {
          enabled: true,
          limit: parameter.paginationLimit || 5,
        },
      }).render(document.querySelector(parameter.tableId));
    } catch (error) {
      console.error("Error fetching or rendering table:", error);
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

export function generateTableRowButtons(parameters) {
  let buttons = "";

  if (parameters.view) {
    buttons += `
      <a href="#" class="inline-flex items-center justify-center rounded-lg p-2 bg-cyan-500 hover:bg-cyan-600 focus:ring-4 focus:ring-cyan-300 dark:bg-cyan-700 dark:hover:bg-cyan-800 dark:focus:ring-cyan-800">
        <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
          <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd"/>
        </svg>
      </a>
    `;
  }

  if (parameters.edit) {
    buttons += `
      <a href="#" class="inline-flex items-center justify-center bg-yellow-400 hover:bg-yellow-500 dark:focus:ring-yellow-900 focus:ring-4 rounded-lg p-2 focus:outline-none">
        <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
          <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/>
          <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/>
        </svg>
      </a>
    `;
  }

  if (parameters.delete) {
    buttons += `
      <a href="#" class="inline-flex items-center justify-center bg-red-700 hover:bg-red-800 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 focus:ring-4 rounded-lg p-2 focus:outline-none">
        <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
          <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
        </svg>
      </a>
    `;
  }

  return buttons;
}
