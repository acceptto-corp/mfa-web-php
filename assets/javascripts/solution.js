(function() {
  $(function() {
    var _this = this;
    $('#myTab a:first').tab('show');
    $('.tab-link a').click(function() {
      var link;
      link = $(this).attr('href').toLowerCase();
      return $('#myTab li').each(function() {
        var currentLink;
        $(this).removeClass('active');
        currentLink = $(this).find('a').attr('href'.toLowerCase());
        if (currentLink === link) {
          $(this).addClass('active');
          return $('html, body').animate({
            scrollTop: 0
          }, 600);
        }
      });
    });
    return $('.scrollup').bind('click', function(event) {
      $('html, body').animate({
        scrollTop: 0
      }, 600);
      return false;
    });
  });

}).call(this);
