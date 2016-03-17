$('[data-switch]').on('click', function () {
    var action = $(this).data('switch');
    var currentMonth = $('.month.active');
    var currentIndex = currentMonth.index();
    var count = $('.month').length;

    switch(action) {
        case 'previous':
            if (currentIndex < 3) return;

            currentMonth.removeClass('active');

            var newIndex = currentIndex - 3;
            $($('.month')[newIndex]).addClass('active');
            break;
        case 'next':
            if (currentIndex > count) return;

            currentMonth.removeClass('active');
            
            var newIndex = currentIndex - 1;
            $($('.month')[newIndex]).addClass('active');
            break;
    }

    if (newIndex <= 0) $('[data-switch="previous"] a').hide();
    else $('[data-switch="previous"] a').show();

    if (newIndex >= (count - 1)) $('[data-switch="next"] a').hide();
    else $('[data-switch="next"] a').show();

});
