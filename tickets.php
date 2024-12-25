<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management</title>

    <?php include_once 'includes/commons/css-common-includes.html'; ?>
</head>
<body>
        <?php
            $page = 'Tickets';
            include_once 'includes/commons/common-includes.php';
        ?>

        <div class="content">
            <div class="content-main block-container">
                <div class="table-header-buttons">
                    <button type="button" class="btn btn-sm btn-secondary btnCreate" data-bs-toggle="modal" data-bs-target="#ticketModal">
                        <i class="fa fa-plus"></i> New Ticket
                    </button>
                </div>
                <table class="table table-bordered table-hover table-striped" id="ticketTable">
                    <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>Project Name</th>
                            <th>Subject</th>
                            <th>Date Created</th>
                            <th>Created By</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

    <?php 
        include_once 'includes/commons/js-common-includes.html';
        include_once 'includes/modals/ticket-modals.html';
    ?>

    <script src="js/ticket.js"></script>
</body>
</html>