<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ITS Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- jQuery - http://jquery.com/ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

    <!-- Bootstrap - http://getbootstrap.com/ -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Bootswatch - https://bootswatch.com/ -->
    <link rel="stylesheet" href="styles/bootswatch.css">

    <!-- jQuery Validation Plugin - https://jqueryvalidation.org/ -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <link rel="stylesheet" href="styles/site.css">
    <script src="scripts/ajax.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">ITS Portal</a>
        </div>

        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="its.php">ITS Support</a></li>
            <li><a href="faqs.php">FAQS</a></li>
            <li><a href="bonus.php">Bonus</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1>ITS Portal</h1>
    <p>If you need help with anything IT related at ITS, the ITS Portal is your first point of contact.</p>
    <p>In order to raise an issue with the ITS support staff, add a new ticket and we’ll be happy to help. Once a ticket has been added to the system we will respond to you as soon
as possible with an ETA for the ticket closure date.</p>
    
    <div class="form-inline">
        <input type="text" class="form-control input-sm" style="margin-bottom: 2%" id="search-email" name="search-email" value="*" placeholder="Search tickets by email..." />
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ticket-modal">Add New Ticket</button>
    </div>

    <table id="ticket-table" class="table table-hover">
        <thead>
        <tr>
            <th>Ticket ID</th>
            <th>Email</th>
            <th>System</th>
            <th>Status</th>
            <th>Issue</th>
            <th>Comments</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal -->
<div id="ticket-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Ticket</h4>
            </div>

            <div class="modal-body">
                <form id="ticket-form" method="POST">
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="first-name">First Name:</label>
                            <input type="text" class="form-control" id="first-name" name="first-name">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="last-name">Last Name:</label>
                            <input type="text" class="form-control" id="last-name" name="last-name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="system">Operating System:</label>
                        <select class="form-control" id="system" name="system">
                            <option class="form-control" value="Windows">Windows</option>
                            <option class="form-control" value="Mac OS X">Mac OS X</option>
                            <option class="form-control" value="Ubuntu">Ubuntu</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="issue">Issue:</label>
                        <input type="text" class="form-control" id="issue" name="issue">
                    </div>

                    <button type="submit" class="btn btn-info btn-sm submit">Submit </button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="comment-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Comments</h4>
            </div>

            <div class="modal-body">
                <table id="comment-table" class="table table-hover">
                    <thead>
                    <tr><th>Comments</th></tr>
                    </thead>
                    <tbody></tbody>
                </table>

                <h5 style="font-weight: bold">Add New Comment Below:</h5>
                <form id="comment-form" method="POST">
                    <input type="hidden" id="ticket-id" name="ticket-id"/>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                    </div>

                    <button type="submit" class="btn btn-info btn-sm">Submit</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>
</html>