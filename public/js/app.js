
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

function myMap() {
    var mapCanvas = document.getElementById("map");
    var mapOptions = {
        center: new google.maps.LatLng(51.5, -0.2),
        zoom: 10
    };
    var map = new google.maps.Map(mapCanvas, mapOptions);
}
