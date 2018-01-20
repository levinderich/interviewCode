<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ITS Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- List.js - http://listjs.com/ -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>

    <!-- jQuery - http://jquery.com/ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

    <link rel="stylesheet" href="styles/bonus.css">
    <script src="scripts/bonus.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">ITS Portal</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="its.php">ITS Support</a></li>
            <li><a href="faqs.php">FAQS</a></li>
            <li class="active"><a href="#">Bonus</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1>ITS Support Centre</h1>

    <div id="tickets">
        <input class="search" placeholder="Search..." />
        <table id="ticket-table" class="table table-hover">
            <thead>
            <tr>
                <th class="sort" data-sort="id">Ticket ID</th>
                <th class="sort" data-sort="email">Email</th>
                <th class="sort" data-sort="system">System</th>
                <th class="sort" data-sort="status">Status</th>
                <th class="sort" data-sort="issue">Issue</th>
            </tr>
            </thead>
            <tbody class="list"></tbody>
        </table>
    </div>
</div>
</body>
</html>
