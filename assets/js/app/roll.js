$.fn.scrollTo = function( target, options, callback ){
    if(typeof options == 'function' && arguments.length == 2){ callback = options; options = target; }
        var settings = $.extend({
            scrollTarget  : target,
            offsetTop     : 350,
            duration      : 150,
            easing        : 'swing'
        }, options);
    
    return this.each(function(){
        var scrollPane = $(this);
        var scrollTarget = (typeof settings.scrollTarget == "number") ? settings.scrollTarget : $(settings.scrollTarget);
        var scrollY = (typeof scrollTarget == "number") ? scrollTarget : scrollTarget.offset().top + scrollPane.scrollTop() - parseInt(settings.offsetTop);
        scrollPane.animate({scrollTop : scrollY }, parseInt(settings.duration), settings.easing, function(){
            if (typeof callback == 'function') { callback.call(this); }
        });
    });
};

function roll(next) {
    var count = parseInt($('.roll-students').data('count'));

    // Si fin de l'appel on valide le formulaire
    if (next >= count) {
        $('.students-form').submit();
        return;
    }

    $('.roll-student.current').removeClass('current');
    $('.roll-student[data-index="'+ next +'"]').addClass('current');
    $('.roll-students').scrollTo('.roll-student[data-index="'+ next +'"]');
}

$(document).on('keyup', function (e) {
    e.preventDefault();
    var current = $('.roll-student.current');
    var index = parseInt(current.data('index'));

    switch (e.keyCode) {
        case 13: // Absent
            current.children('.hidden').children('input').attr('checked', true);
            current.addClass('missing');
            roll(index+1);
            break;
        case 32: // Present
            roll(index+1);
            break;
    }
});
