/**
 * Created by levinderich on 19/8/17.
 */
$(document).ready(function () {
    var options = {
        valueNames: ['movie', 'session', 'cinema']
    };
    var ticketList = new List('tickets', options);

    $('.custom-search').bind("change keyup input", function () {
        updateList();
    });

    function updateList() {
        var movie = $('#movie-search').val().toLowerCase();
        var cinema = $('#cinema-search').val().toLowerCase();
        var sessionFrom = $('#session-from').val();
        var sessionTo = $('#session-to').val();

        ticketList.filter(function (item) {
            var movieFilter = false;
            var cinemaFilter = false;
            var sessionFilter = false;

            if (movie === '') {
                movieFilter = true;
            }
            else {
                movieFilter = item.values().movie.toLowerCase().indexOf(movie) >= 0;
            }

            if (cinema === '') {
                cinemaFilter = true;
            }
            else {
                cinemaFilter = item.values().cinema.toLowerCase().indexOf(cinema) >= 0;
            }

            if (sessionFrom === '' || sessionTo === '') {
                sessionFilter = true;
            }
            else {
                var fromDate = new Date(sessionFrom);
                var toDate = new Date(sessionTo);
                var checkDate = new Date(item.values().session);

                console.log('Dates: ' + fromDate + ' ' + toDate + ' ' + checkDate);

                sessionFilter = checkDate >= fromDate && checkDate <= toDate;
            }

            return movieFilter && cinemaFilter && sessionFilter
        });

        ticketList.update();
        console.log('\n');
    }
});