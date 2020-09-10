

$('.pathable a').toArray().forEach((element) => {
  $href = $(element).attr('href').split('//')[1];
  $currentPath = location.host + location.pathname;
  if($href === $currentPath || $href + '/' === $currentPath) {
    $(element).addClass('naw-current')
  }
});

