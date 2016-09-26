function deleteTogglerCallback(event){
  var id = $(event.currentTarget).data('id');

  $('#deleteModal')
    .modal({
      onApprove: function() {
        window.location.href = siteConfig.baseUri + "users/delete/" + id;
      }
    })
    .modal('show')
}

$(document).ready(function() {

  $("#example").DataTable({
    serverSide: true,
    language: { "url": siteConfig.baseUri + "public/json/spanish-datatable.json" },
    ajax: {
      url: siteConfig.baseUri + "users/index",
      method: "POST"
    },
    columns: [
      {data: "id", searchable: false},
      {data: "name"},
      {data: "email"},
      {data: "active"}
    ],
    "aoColumnDefs":[
      {
        "mRender": function ( data, type, row ) {
          var editUrl = siteConfig.baseUri + "users/edit/" +data.id;

          var editIcon   = templates.getIconButton({color: 'blue', icon: 'edit'});
          var deleteIcon = templates.getIconButton({color: 'red', icon: 'trash'});

          var template = templates.getLink({url: editUrl, element: editIcon});
          template    += '<a onclick="deleteTogglerCallback(event)" class="delete" data-id="' + data.id + '">' + deleteIcon + '</a>';

          return template;
        },
        "aTargets":[4],
        "mData": null
      },
      {
        "mRender": function ( data, type, row ) {
          var icon  = data === "Y" ? "checkmark" : "remove";
          var color = data === "Y" ? "teal" : "red";

          var template = templates.getIconButton({color: color, icon: icon});

          return template;
        },
        "aTargets": [3],
        "mData": null
      }
    ]
  });
});
