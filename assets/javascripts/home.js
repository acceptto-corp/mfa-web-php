(function() {
  $(function() {
    var _this = this;
    $('.loader').hide();
    $('#sendbtn').bind('click', function(event) {
      $('#sendbtn').hide();
      $('.msg').hide();
      $('#error-msg').hide();
      return $('.loader').show();
    });
    $("#new_user").on("ajax:success", function(e, data, status, xhr) {}).bind("ajax:error", function(e, xhr, status, error) {
      alert('oOops! invitation request failed!');
      $('#sendbtn').show();
      $('.loader').hide();
      $('.putting').hide();
      return $('.p-putting').hide();
    });
    if (window.location.pathname === '/') {
      init_animation();
      $('.putting').fadeIn('slow');
      $('.p-putting').fadeIn('slow');
    }
    if (window.location.pathname === '/user_experience') {
      $('.hand').fadeIn('slow');
    }
    if (window.location.pathname === '/' || window.location.pathname === '/user_experience') {
      $('.app-icon,.app-store,.google-play').show();
      $('.footer').hide();
      $('body').css('overflow', 'hidden');
    } else {
      $('.app-icon,.app-store,.google-play').hide();
    }
    if (window.location.pathname === '/users/sign_in' || window.location.pathname === '/users/unlock/new' || window.location.pathname === '/users/sign_up' || window.location.pathname === '/users/confirmation/new' || window.location.pathname === '/users/password/new') {
      $('#new_user').addClass('new_user_devise');
      return $('#new_user').parent().addClass('new_user_parent');
    }
  });

}).call(this);
