$(document).ready(function() {
  $("#example").DataTable({
    serverSide: true,
    ajax: {
      url: "/solved/users/index",
      method: "POST"
    },
    columns: [
      {data: "id", searchable: false},
      {data: "name"},
      {data: "email"},
      {data: "active"}
    ],
    drawCallback: function () {
      console.log("foooo");
      $(".dataTables_paginate").addClass("ui pagination floated left menu");
      $(".paginate_button").addClass("item button");
      $(".paginate_button.previous").addClass("icon").html("<i class='left chevron icon'></i>");
      $(".paginate_button.next").addClass("icon").html("<i class='right chevron icon'></i>");
    }
  });
});
