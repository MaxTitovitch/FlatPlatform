$.fn.datepicker.dates['ru'] = {
    days: [ "Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
    daysShort: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
    daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
    months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
    monthsShort: ["Янв", "Фев", "Март", "Апр", "Май", "Июнь", "Июль", "Авг", "Сен", "Окт", "Ноя", "Дек"],
    today: "Today",
    clear: "Clear",
    format: "dd-mm-yyyy",
    titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
    weekStart: 1
};
$('.datepicker').datepicker({
    format: "dd-mm-yyyy",
    language: 'ru',
    orientation: 'bottom'
});

let changeData = function (selector){
    let date = $(`[name="${selector}"]`).eq(0);
    if(date.val().trim() !== ''){
        let text = date.val();
        text = text.split('-').reverse().join('-');
        date.val(text);
    }
}

$('form').submit(function (event) {
    changeData("date_of_birth");
    changeData("date_of_issue");
})

