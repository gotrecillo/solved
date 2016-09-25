$(document).ready(function() {
  $(".ui.dropdown").dropdown({ on: "hover" });

  $("#sidebarMenu")
    .sidebar(
      {
        transition: "scale down",
        dimPage: false,
        closable: false,
        context: $(".bottom.segment")
      })
    .sidebar("attach events", "#sidebarMenuToggler");

    $(".ui.accordion").accordion();
});
