let crossEvent = el => {
  $(el).click(function (event) {
    let section = $(this).parent().find('section').eq(0);
    if(!section.hasClass('none-section')) {
      let data = {
        '_method': 'DELETE',
        '_token': $('[type="hidden"]').eq(0).val(),
      }
      $.post({
        url:  section.attr('data-action'),
        data: data
      })
    }
    $(this).closest('.cross-click').eq(0).parent().remove();
  });
}

$('.cross').toArray().forEach(crossEvent);

$('.multiple-btn').toArray().forEach(el => {
  $(el).click(() => {
    $('.multiple-files').click();
  });
});

$(".multiple-files").change(function() {
  $('.image-to-remove').toArray().forEach(function (el) {
    $(el).remove();
  })
  if (this.files && this.files[0]) {
    for (let i = 0; i < this.files.length; i++) {
      let reader = new FileReader(); let img;
      reader.onload = function(e) {
        img = createImage(e.target.result);
        $('.image-user').attr('src', e.target.result);
      }
      reader.readAsDataURL(this.files[i]);
      // img.css({'height': img.css('width')});
    }
  }
});

function createImage (src) {
   let clone = $('.template-div').eq(0).clone();
   clone.removeClass('template-div');
   clone.removeClass('display-none');
   clone.addClass('image-to-remove');
   clone.find('img').eq(0).attr('src', src);
   clone.find('.cross').toArray().forEach(crossEvent);
   $('.img-row').eq(0).append(clone);
}