

$('#messageSender').submit(function(event) {
  event.preventDefault();
  let value = $(this).find('.message-input').eq(0).val();
  if(value){
    $.post({
      url: $(this).attr('action'),
      data: {
        message: $(this).find('.message-input').eq(0).val(),
        _token: $(this).find('[name="_token"]').eq(0).val(),
      },
      success: r => {
        $(this).find('.message-input').eq(0).val('')
      },
      error: e => {
        console.log(e);
      }
    });
  }
});

setInterval(() => {
  let id = $('.first-user-message, .second-user-message:last').data('idlast');
  let userId = $('.message-body').eq(0).data('user-id');
  $.get({
    url: $('.get-action-message').data('message-action').replace('TOREPLACE', id),
    success: r => {
      if(r.length > 0) {
        for (let i = 0; i < r.length; i++) {
            let className;
            if(r[i].user_id == userId) {
              className = 'second-user-message';
            } else {
              className = 'first-user-message';
            }
            let clone = $(`.${className}:last`).clone();
            clone.find('.rounded').html(r[i].message + '<span class="message-time">' + r[i].created_at.substr(11, 5) + '</span>');
            clone.data('idlast', r[i].id);
            clone.appendTo('.super-messager');
        }
      }
    }
  });
}, 500);

$('.svg-btn').click(event => {
  event.preventDefault();
  $('[name="file"]').click();
});
$.ajaxSetup({
  headers: {
    'X-XSRF-TOKEN': $('#messageSender').find('[name="_token"]').eq(0).val(),
    'X-Requested-With': 'XMLHttpRequest'
  }
});

$('[name="file"]').change(function (event) {
  console.log();
  if (this.files && this.files[0]) {
    let fd = new FormData;
    fd.append('file', this.files[0]);
    fd.append('_token', $('#messageSender').find('[name="_token"]').eq(0).val());

    $.post({
      url: $('#messageSender').attr('action'),
      data: fd,
      processData: false,
      contentType: false,
      dataType: 'json',
      success: r => {
        console.log(r);
        $(this).val('');
      },
      error: e => {
        console.log(e.responseText);
      }
    });
  }
});