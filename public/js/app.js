
$('.flat-slider').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    prevArrow: '<span class="arrow-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
    nextArrow: '<span class="arrow-next"><i class="fa fa-angle-right" aria-hidden="true"></i></span>',
});

$('.household-slider').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    prevArrow: '<span class="arrow-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
    nextArrow: '<span class="arrow-next"><i class="fa fa-angle-right" aria-hidden="true"></i></span>',
});

$('.statistic-container').height($('.statistic-container').eq(0).width())
