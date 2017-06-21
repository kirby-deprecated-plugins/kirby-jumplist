$.fn.jumplistfield = function() {

  var jumplist = $("div.field-jumplist").children();

  jumplist.detach();
  $("div.field-jumplist").remove();

  if($("header.topbar div.languages").length) {
    $("header.topbar div.languages").before(jumplist);
    jumplist.addClass("with-languages");
  } else {
    $("header.topbar a.nav-icon.nav-icon-right").before(jumplist);
  }

  if(window.console) {
    console.log("[jumplist] initialized")
  }

};