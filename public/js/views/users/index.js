$(document).ready(function() {
  $("#example").DataTable({
    serverSide: true,
    language: { "url": "/solved/public/json/spanish-datatable.json" },
    ajax: {
      url: "/solved/users/index",
      method: "POST"
    },
    columns: [
      {data: "id", searchable: false},
      {data: "name"},
      {data: "email"},
      {data: "active"}
    ]
  });
});
