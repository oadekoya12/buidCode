$(document).ready(function(){
  $("ul.sub-menu").parent().addClass("dropdown");
  $("ul.sub-menu").addClass("dropdown-menu");
  $("ul#main-menu li.dropdown a").addClass("dropdown-toggle");
  $("ul.sub-menu li a").removeClass("dropdown-toggle");
  $('.navbar .dropdown-toggle').append('<b class="caret"></b>');
  $('a.dropdown-toggle').attr('data-toggle', 'dropdown');
});
