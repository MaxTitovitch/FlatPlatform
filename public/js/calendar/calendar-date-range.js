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
