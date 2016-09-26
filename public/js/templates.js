var templates = {
  getIconButton: function(params){
    var color = params.color;
    var icon = params.icon;

    var template = '<button class="ui ' + color + ' icon button">';
    template += '<i class="' + icon + ' icon"></i>';
    template += '</button>';

    return template;
  },

  getLink: function(params){
    var url = params.url;
    var element = params.element;

    var template = '<a href="' + url + '">' + element + '</a>';
    return template;
  }
}
