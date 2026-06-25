$(function () {

  var link = document.location.href.split('/');

  var url = link[4];



  if (typeof (url) === 'undefined') {

    var url = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);

    $('[href$="' + url + '"]').addClass("active");

  }

  $('.tree li').removeClass('active');



  $('[href$="' + url + '"]').parent().addClass("active");

  $('[href$="' + url + '"]').addClass("active");

  $('.has-treeview').removeClass('active menu-open');

  $('[href$="' + url + '"]').closest('li.has-treeview').addClass("active menu-open");



  $('.super-menu').removeClass('active');

  $('.menu-open .super-menu').addClass("active");



  if (link[4] == 'meta-tags' && link[5] == 'category') {
    $('#custom-tabs-two-home-tab').removeClass('active');

  }

  if (link[4] == 'meta-tags' && link[5] == 'item') {
    $('#custom-tabs-two-home-tab').removeClass('active');

  }

  if (link[4] == 'meta-tags' && link[5] == 'blog') {
    $('#custom-tabs-two-home-tab').removeClass('active');
  }
  if (link[4] == 'meta-tags' && link[5] == 'artist-category') {
    $('#custom-tabs-two-home-tab').removeClass('active');
  }
  if (link[4] == 'meta-tags' && link[5] == 'blog-category') {
    $('#custom-tabs-two-home-tab').removeClass('active');
  }

});