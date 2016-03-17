
/* 
 * ------------------------------------
 *               SCRIPT
 * ------------------------------------
 * 
 */

var App = {};

$(document).on('click', 'a[href="#"]', function (e) {
    e.preventDefault();
});

setTimeout(function () {

    $('.alert').slideUp();

}, 3000);

App.calendar = {};

App.calendar.courseList = function (courses, absences, date) {

    var container = $('.course-list');
    var items = $('.view-course', container);

    // Hide courses items
    $('.item-choose-date').hide();
    $('.item-no-absences').hide();
    $('.item-no-courses').hide();

    var hasAbsences = false;
    var hasCourses = false;

    // Pour chaque lien
    items.each(function () {

        // On récupère le lien
        var $link = $(this);

        // On récupère l'ID du cours
        var courseId = ~~$link.data('id');

        // On regarde si il est dans la variable "courses"
        // Pour savoir si il y a cours ce jour ou pas
        var courseThisDay = courses.indexOf(courseId) > -1;

        // On le cache
        $link.hide();
        $link.removeClass('missing');

        if (courseThisDay) {

            // Il y a eu cours
            hasCourses = true;

            // On regarde si il est dans la variable "absences"
            // Pour savoir si il était absent à ce cours
            $.each(absences, function () {
                var absenceId = ~~this[0],
                    absenceAt = ~~this[1];

                if (absenceAt === courseId) {

                    // On affiche le lien
                    $link.show();
                    $link.addClass('missing');

                    // Il y a eu une absence
                    hasAbsences = true;

                    // Et on fait le lien
                    $link.attr('href', $link.data('src') + absenceId + '/');

                }

            });

        }

        if (hasCourses) {
            if (!hasAbsences) {
                $('.item-no-absences').show();
            }
        } else {
            $('.item-no-courses').show();            
        }
        
    });
    return false;
};
