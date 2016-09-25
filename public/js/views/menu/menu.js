$(document).ready(function() {
  $(".ui.dropdown").dropdown({ on: "hover" });

  $("#sidebarMenu")
    .sidebar(
      {
        dimPage: false,
        closable: false,
        context: $(".bottom.segment")
      })
    .sidebar("attach events", "#sidebarMenuToggler");

    $(".ui.accordion").accordion();
});
