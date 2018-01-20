/**
 * ajax.js
 *
 * Sends AJAX requests, sending commands to the server.php that is implemented
 * as a Chain of Commands
 */

$(document).ready(function () {
    // Initialise table, search-email starts as "*" selecting all tickets
    var searchEmail = $("#search-email");
    getTickets(searchEmail.val());

    // Search by email
    searchEmail.keyup(function () {
        getTickets($(this).val());
    });

    // Add ticket, validation with jQuery Validation Plugin:
    // https://jqueryvalidation.org/
    $("#ticket-form").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            "first-name": "required",
            "last-name": "required",
            issue: "required"
        },
        submitHandler: function (form) {
            var formData = "command=addTicket&" + $(form).serialize();

            $.post("api/server.php", formData, function (data) {
                var ticketID = $("#search-email").val();
                getTickets(ticketID);
                $(".modal").modal("hide");
                $("#ticket-form")[0].reset();
            });
        }
    });

    // Add comment, validation with jQuery Validation Plugin:
    // https://jqueryvalidation.org/
    $("#comment-form").validate({
        rules: {
            name: "required",
            comment: "required"
        },
        submitHandler: function (form) {
            var formData = "command=addComment&" + $(form).serialize();

            $.post("api/server.php", formData, function (data) {
                var ticketID = $("#ticket-id").val();
                getComments(ticketID);
                $("#comment-form")[0].reset();
            });
        }
    });

    // Populate ticket-table with tickets based on email, passing "*" selects
    // all tickets
    function getTickets(email) {
        // Depending on page hide or show status options
        var page = location.href.split("/").slice(-1)[0];
        var statusRow;
        if (page === "index.php" || page === "") {
            statusRow = '<td><select class="form-control input-sm"><option style="display: none">Pending</option><option style="display: none">In Progress</option><option style="display: none">Unresolved</option><option>Resolved</option><select></td>'
        } else if (page === "its.php") {
            statusRow = '<td><select class="form-control input-sm"><option>Pending</option><option>In Progress</option><option>Unresolved</option><option>Resolved</option><select></td>'
        }

        $.get("api/server.php", "command=getTickets&email=" + email, function (data) {
            var ticketTable = $("#ticket-table");

            // Reset table since we need to append rows one at a time so we
            // can add selected status to each rows select element
            ticketTable.find("tbody").html("");

            $.each(data, function (key, value) {
                row = '<tr>';
                row = row + '<td>' + value.id + '</td>';
                row = row + '<td>' + value.user_email + '</td>';
                row = row + '<td>' + value.system + '</td>';
                row = row + statusRow;
                row = row + '<td>' + value.issue + '</td>';
                row = row + '<td><button class="btn btn-info btn-sm">View Comments</button></td>';
                row = row + '</tr>';

                ticketTable.find("tbody").append(row);

                ticketTable.find("tr select:last").val(value.status);
            });

            // Add on change event to all status selects after rows are added
            ticketTable.find("tr select").change(function () {
                var ticketId = $(this).closest("tr").children(":first-child").text();
                var status = $(this).val();
                updateStatus(ticketId, status);
            });

            // Add on click event to all view comments buttons after rows are
            // added
            ticketTable.find("tr button").click(function () {
                var ticketID = $(this).closest("tr").children(":first-child").text();
                $("#ticket-id").val(ticketID);
                getComments(ticketID);
                $("#comment-modal").modal("show");
            });
        }, "json");
    }

    function getComments(ticketId) {
        $.get("api/server.php", "command=getComments&ticket-id=" + ticketId, function (data) {
            var rows = '';
            $.each(data, function (key, value) {
                rows = rows + '<tr><td>' + value.comment + '</td></tr>';
            });

            $("#comment-table").find("tbody").html(rows);
        }, "json");
    }

    function updateStatus(ticketId, status) {
        var dataUrl = "command=updateStatus&ticket-id=" + ticketId + "&status=" + status;
        $.post("api/server.php", dataUrl, function (data) {
        });
    }
});
