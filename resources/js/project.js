import { instantiateDatatable, observeTableRendering } from "./helper";

// Initialize the datatable
instantiateDatatable([
  {
    tableId: "#projectTable",
    url: "/projects/all",
    columns: [
      { data: "id" },
      { data: "project_name" },
      { data: "project_phase" },
      { data: "project_status" },
    ],
  },
]);

function styleProjectStatus() {
  const tableElement = document.querySelector("#projectTable");

  const rows = tableElement.querySelectorAll("tbody tr");
  rows.forEach((row) => {
    const statusCell = row.cells[3];
    if (statusCell) {
      const status = statusCell.textContent.trim();

      switch (status) {
        case "Not Started":
          statusCell.innerHTML = `<span class="bg-blue-100 text-blue-700 px-2 py-1 rounded">Not Started</span>`;
          break;
        case "In Progress":
          statusCell.innerHTML = `<span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">In Progress</span>`;
          break;
        case "Completed":
          statusCell.innerHTML = `<span class="bg-green-100 text-green-700 px-2 py-1 rounded">Completed</span>`;
          break;
        case "On Hold":
          statusCell.innerHTML = `<span class="bg-orange-100 text-orange-700 px-2 py-1 rounded">On Hold</span>`;
          break;
        case "Cancelled":
          statusCell.innerHTML = `<span class="bg-red-100 text-red-700 px-2 py-1 rounded">Cancelled</span>`;
          break;
        case "Blocked":
          statusCell.innerHTML = `<span class="bg-purple-100 text-purple-700 px-2 py-1 rounded">Blocked</span>`;
          break;
        default:
          statusCell.innerHTML = `<span class="bg-gray-100 text-gray-700 px-2 py-1 rounded">${status}</span>`;
      }
    } else {
      console.error(`Status cell not found in row:`, row);
    }
  });
}

observeTableRendering("#projectTable", styleProjectStatus);
