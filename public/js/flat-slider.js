let slider = $('.flat-id-slider').eq(0);
if(slider.children().length < 3)  {
    slider.children().toArray().forEach(el => {
        $(el).css({flex: '0 0 50%', 'max-width': '50%'})
    })
} else {
    slider.slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        prevArrow: '<span class="arrow-re-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
        nextArrow: '<span class="arrow-re-next"><i class="fa fa-angle-right" aria-hidden="true"></i></span>',
    });
}