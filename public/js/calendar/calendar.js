
mobiscroll.settings = {
    lang: 'ru',
    theme: 'ios',
    themeVariant: 'light'
};

$(function () {
    $('#dateStart').val(new Date().toLocaleDateString().split('.').reverse().join('-'));
    $('#multi-day1').mobiscroll().calendar({
        display: 'inline',
        select: 'none',
        min: new Date(),
    });

    $('.mbsc-selected').click();

    let changeDateEnd = event => {
        let date = $('#multi-day1').mobiscroll('getVal');
        if(!date) {
            date = new Date();
        }
        if($('.type-rental').text() == 'Помесячно') {
            date.setMonth(date.getMonth() + Number.parseInt($('.amount-date').val()));
            // date.setDate(date.getDate() - 1);
        } else {
            date.setDate(date.getDate() + Number.parseInt($('.amount-date').val()) -1);
        }
        $('#dateEnd').val(new Date(date + 1000).toLocaleDateString().split('.').reverse().join('-'));
    };

    if($('#dateEnd').toArray().length > 0){
        if($('.type-rental').text() == 'Помесячно') {
            let date = new Date();
            date.setMonth(date.getMonth() + Number.parseInt($('.amount-date').val()));
            // date.setDate(date.getDate() - 1);
            $('#dateEnd').val(date.toLocaleDateString().split('.').reverse().join('-'));
        } else {
            $('#dateEnd').val(new Date().toLocaleDateString().split('.').reverse().join('-'));
        }
        $('.amount-date').change(changeDateEnd);
    }


    $('#multi-day1').change(function (event) {
        let date = $(this).mobiscroll('getVal').toLocaleDateString().split('.').reverse().join('-');
        $('#dateStart').val(date);
        if($('#dateEnd').toArray().length > 0) {
            changeDateEnd();
        }
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