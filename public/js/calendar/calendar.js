
mobiscroll.settings = {
    lang: 'ru',
    theme: 'ios',
    themeVariant: 'light'
};

$(function () {
    function getDates () {
        return JSON.parse($('.dates').eq(0).text());
    }

    let dates = getDates();
    $('#multi-day').mobiscroll().calendar({
        display: 'inline',
        select: 'none',
        colors: [
            ...dates.serviceDates.map(el => {
                return {background: '#e87d07', d: new Date(el)}
            }),
            ...dates.flatDates.map(el => {
                return {background: '#e20516', d: new Date(el)}
            })
        ]
    });

    setTimeout(deleteSecurity, 100);
    setTimeout(() => $('.mbsc-ic').click(deleteSecurity), 100);
    setTimeout(() => $('.mbsc-cal-cell').click(deleteSecurity), 100);
});

$(function () {
    function getDates () {
        return JSON.parse($('.dates').eq(0).text());
    }

    let dates = getDates();
    $('#multi-day1').mobiscroll().calendar({
        display: 'inline',
        select: 'none',
        colors: [
            ...dates.serviceDates.map(el => {
                return {background: '#e87d07', d: new Date(el)}
            }),
            ...dates.flatDates.map(el => {
                return {background: '#e20516', d: new Date(el)}
            })
        ]
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
