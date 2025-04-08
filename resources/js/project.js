import { generateTableRowButtons, instantiateDatatable } from "./helper";

instantiateDatatable({
  tableId: "#projectTable",
  url: "/projects",
  columns: [
    {
      title: "Project ID",
      data: "id",
      sort: true,
    },
    {
      title: "Project Name",
      data: "project_name",
      sort: true,
    },
    {
      title: "Phase",
      data: "phase_id",
      sort: false,
    },
    {
      title: "Status",
      data: (row) => {
        const statusClasses = {
          "Not Started": "bg-blue-100 text-blue-700 px-2 py-1 rounded",
          "In Progress": "bg-yellow-100 text-yellow-700 px-2 py-1 rounded",
          Completed: "bg-green-100 text-green-700 px-2 py-1 rounded",
          "On Hold": "bg-orange-100 text-orange-700 px-2 py-1 rounded",
          Cancelled: "bg-red-100 text-red-700 px-2 py-1 rounded",
          Blocked: "bg-purple-100 text-purple-700 px-2 py-1 rounded",
        };

        const status = row.project_status || "Unknown Status";
        return `<span class="${
          statusClasses[status] || "bg-gray-100 text-gray-700 px-2 py-1 rounded"
        }">
          ${status}
        </span>`;
      },
      sort: false,
    },
    {
      title: "Action",
      data: (row) => {
        return generateTableRowButtons({
          view: true,
          delete: true,
        });
      },
      sort: false,
    },
  ],
  paginationLimit: 10,
});
