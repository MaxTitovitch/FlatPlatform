
mobiscroll.settings = {
    lang: 'ru',
    theme: 'ios',
    themeVariant: 'light'
};

$(function () {

    $('#multi-day1').mobiscroll().calendar({
        display: 'inline',
        select: 'none',
    });

    setTimeout(deleteSecurity, 100);
    setTimeout(() => $('.mbsc-ic').click(deleteSecurity), 100);
    setTimeout(() => $('.mbsc-cal-cell').click(deleteSecurity), 100);
});

let deleteSecurity = () => {
    setInterval(() => {
        $('div:contains("TRIAL")').toArray().forEach(el => {
            if($(el).text() === "TRIAL") {
                $(el).text('')
            }
        });
    }, 100);
};
