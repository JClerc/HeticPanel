var currentMonth = $('.month.active');
var currentMonthIndex = ~~currentMonth.data('index');

$('[data-switch]').on('click', function () {
    var activeMonth = $('.month.active');
    var activeIndex = ~~activeMonth.data('index');
    var change = activeIndex + ~~$(this).data('change');
    var target = $('.month[data-index="' + change + '"]');

    if (target.length > 0) {
        target.addClass('active');
        activeMonth.removeClass('active');

        if (change <= 0) $('[data-switch="prev"]').hide();
        else $('[data-switch="prev"]').show();

        if (change >= currentMonthIndex) $('[data-switch="next"]').hide();
        else $('[data-switch="next"]').show();
    }
});
