

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
          $(this).find('.message-input').eq(0).val('');
      },
      error: e => {
        console.log(e);
      }
    });
  }
    $(this).find('.message-input').eq(0).val('');
});

let uppendData = (className, ri) => {
  let clone = $(`.${className}:last`).clone();

  let message = '';
  if(ri.type == 'Текст' || ri.type == 'Служебное') {
    message = ri.message;
  } else {
    if(['png', 'git', 'jpeg', 'jpg'].indexOf( ri.message.split('.')[1] ) != -1) {
      message = `<img src="${ ri.message }" alt="">`;
    } else if (['ogv', 'mp4', 'webm'].indexOf( ri.message.split('.')[1] ) != -1) {
      message = `<video src="${ ri.message}" controls="controls"></video>`;
    } else {
      message = `<a target="_blank" download href="${ ri.message }"><strong><i>Файл ${  ri.message.split('.')[1].toUpperCase() }</i></strong></a>`;
    }
  }
  if(ri.type != 'Служебное') {
    clone.find('.rounded').html(message + '<span class="message-time">' + ri.created_at.substr(11, 5) + '</span>');
  }
  clone.data('idlast', ri.id);
  clone.removeClass('display-none')
  clone.appendTo('.super-messager');
}

setInterval(() => {
  let id = $('.message-user-all:last').data('idlast') || ('i' + location.href.split('/').reverse()[0]);
  let userId = $('.message-body').eq(0).data('user-id');
  let lastDate = $('.last-data').toArray().reverse()[0];
  if(lastDate){
    lastDate = lastDate.innerText
  }
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
            if(r[i].type == 'Служебное') {
              className = 'no-user-message';
              window.location.reload();
            }
            if(lastDate) {
              if (r[i].created_at.substr(0, 10) !== lastDate) {
                lastDate = r[i].created_at.substr(0, 10);
                $('.super-messager').append(`<div class="last-data my-4 text-center text-primary w-100">${lastDate}</div>`)
              }
            }
            if(!(r[i].type == 'Файл' && r[i].message == 'QWERTY')) {
              uppendData(className, r[i]);
            }
        }
        $('.message-body')[0].scrollTop = 100000;
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
