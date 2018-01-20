/**
 * bonus.js
 *
 * AJAX request to get all tickets and set up list.js
 */
$(document).ready(function () {
    getTickets("*");

    function getTickets(email) {
        $.get("api/server.php", "command=getTickets&email=" + email, function (data) {
            rows = '';
            $.each(data, function (key, value) {
                rows = rows + '<tr>';
                rows = rows + '<td class="id">' + value.id + '</td>';
                rows = rows + '<td class="email">' + value.user_email + '</tdc>';
                rows = rows + '<td class="system">' + value.system + '</td>';
                rows = rows + '<td class="status">' + value.status + '</td>';
                rows = rows + '<td class="issue">' + value.issue + '</td>';
                rows = rows + '</tr>';
            });

            $('#ticket-table').find('tbody').html(rows);

            // set up List.js - http://listjs.com/
            var options = { valueNames: ['id', 'email', 'system', 'status', 'issue'] };
            var ticketList = new List('tickets', options);
        }, "json");
    }
});
