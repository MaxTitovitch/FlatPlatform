

$('.pathable a').toArray().forEach((element) => {
  $href = $(element).attr('href').split('//')[1];
  $currentPath = location.host + location.pathname;
  if($href === $currentPath || $href + '/' === $currentPath) {
    $(element).addClass('naw-current')
  }
});

let sidebar = $('#super-height');
if(sidebar.length > 0) {
    $('main').eq(0).css({'flex': '2'});
    sidebar.eq(0).css({'min-height': $('main').eq(0).height()});
}

$('.br-50').toArray().forEach(el => {
  $(el).css({'height': $(el).css('width')});
});

if($('.super-messager').length > 0 ) {
    let height = $('.message-body').css('height');
    $('.super-messager').eq(0).removeClass('display-none');
    $('.super-messager').css({height});
    $('.message-body')[0].scrollTop = 100000;

}

if($('.summary')) {
    $('.summary').click(el => {
        $('summary').eq(0).click();
        // $('.message-body')[0].scrollTop = $('.summary').offset().top;
        $('.message-body').animate({scrollTop: $('.summary').offset().top - 200}, 0);
    })
}

let role = $('[name="role_id"]');
if(role.length !== 0){
    role.val((new URLSearchParams(window.location.search)).get('type') || 2);
}
