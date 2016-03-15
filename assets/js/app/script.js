
/* 
 * ------------------------------------
 *               SCRIPT
 * ------------------------------------
 * 
 */

var App = {};

App.calendar = {};

App.calendar.courseList = function (courses, absences, date) {

    var container = $('.course-list');
    var items = $('.view-course', container);

    // Pour chaque lien
    items.each(function () {

        // On récupère le lien
        var $link = $(this);

        // On récupère l'ID du cours
        var courseId = ~~$link.data('id');

        // On regarde si il est dans la variable "courses"
        // Pour savoir si il y a cours ce jour ou pas
        var courseThisDay = courses.indexOf(courseId) > -1;

        if (!courseThisDay) {
            // S'il y a pas cours, on cahe le lien
            $link.hide();
        } else {
            // Sinon on l'affiche
            $link.show();

            // On regarde si il est dans la variable "absences"
            // Pour savoir si il était absent à ce cours
            $.each(absences, function () {
                var absenceId = ~~this[0],
                    absenceAt = ~~this[1];

                if (absenceAt === courseId) {

                    // Il etait absent
                    $link.css('color', 'red');

                    // Et on fait le lien
                    $link.attr('href', $link.data('src') + absenceId + '/');

                } else {

                    // Tout est ok
                    $link.css('color', '');

                    // On "supprime" le lien car y'a pas d'absence a voir
                    $link.attr('href', '#');

                }

            });

        }

    });
    return false;
};
