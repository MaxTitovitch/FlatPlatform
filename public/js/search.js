

let urlParams = new URLSearchParams(window.location.search);
let queries = location.search.split('?')[1];
if(queries) {
  queries.split('&').forEach(query => {
    let keyValue = query.split('=');
    let elements = $(`input[name="${keyValue[0]}"],select[name="${keyValue[0]}"]`);
    elements.toArray().forEach((element) => {
      if (element !== null) {
        if(element.tagName === 'select') {
          $(element).children(`option[value="${urlParams.get(keyValue[0])}"]`)[0].selected = true;
        }else if (['checkbox', 'radio'].lastIndexOf(element.getAttribute('type')) === -1) {
          element.value = urlParams.get(keyValue[0]);
        } else {
          if (element.value === urlParams.get(keyValue[0]))
            element.checked = true;
        }
      }
    });
  });
}

$('.pathable-search').toArray().forEach((element) => {
  href = urlParams.get('order') || 'new';

  $('.pathable-search').toArray().forEach(element => {
    if($(element).find('a')[0].getAttribute('href').lastIndexOf(href) !== -1) {
      $(element).addClass('selected-sort');
    }
  })
});
