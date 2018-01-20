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
            <a class="navbar-brand" href="index.php">ITS Portal</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="#">ITS Support</a></li>
            <li><a href="faqs.php">FAQS</a></li>
            <li><a href="bonus.php">Bonus</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1>ITS Support Centre</h1>

    <div class="form-inline">
        <input type="hidden" class="form-control input-sm" style="margin-bottom: 2%" id="search-email" name="search-email" value="*" placeholder="Search tickets by email..." />
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
                        <input type="hidden" name="name" class="form-control" id="name" value="ITS Staff">
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