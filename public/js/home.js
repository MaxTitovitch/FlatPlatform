$('.image-user').css({'height': $('.image-user').css('width')});
$('.upload-avatar').toArray().forEach(el => {
  $(el).click(() => {
    $('.fileblabla').click();
  });
});

$(".fileblabla").change(function() {
  if (this.files && this.files[0]) {
    let reader = new FileReader();
    reader.onload = function(e) {
      $('.image-user').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
    $('.image-user').css({'height': $('.image-user').css('width')});
  }
});