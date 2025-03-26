<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management</title>

    <?php include_once 'includes/commons/css-common-includes.html'; ?>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/select2-custom.css">
    <link rel="stylesheet" href="css/project-detail.css">
    <link rel="stylesheet" href="css/ticket.css">
</head>
<body>
    <?php
        $page = 'Projects';
        include_once 'includes/commons/common-includes.php';
    ?>

    <div class="content">
        <div class="content-main block-container">
            <div class="table-header-columns">
                <a href="tickets.php" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Tickets</a>
                <button type="button" class="btn btn-success btn-sm" id="btnSaveTicket"><i class="fa fa-save"></i> Save Changes</button>
                <hr>
            </div>
            <div class="row">
                <div class="col">
                    <form action="" id="projectForm" class="form-inline">
                        <input type="hidden" id="projectIdInput" name="project_id">
                        <table class="table form-table">
                            <tr>
                                <td class="form-label-custom">Ticket ID</td>
                                <td><input type="text" name="ticket_id" id="ticketIdInput" value="<?=$_GET['id']?>" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <td class="form-label-custom">Category</td>
                                <td><select class="form-control" name="category" id="categorySelect" required>
                                    <option value="">--</option>
                                </select></td>
                            </tr>
                            <tr>
                                <td class="form-label-custom">Project</td>
                                <td><input type="text" name="project" id="projectNameInput" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <td class="form-label-custom">Module</td>
                                <td>
                                    <select name="module" id="moduleSelect" class="form-control">
                                        <option value="">--</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="form-label-custom">Assigned To</td>
                                <td>
                                    <select name="assign_to" id="assignedToSelect" class="form-control">
                                        <option value="">--</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="form-label-custom">Status</td>
                                <td>
                                    <select name="status" id="statusSelect" class="form-control">
                                        <option value="">--</option>
                                </td>
                            </tr>
                            <tr>
                                <td class="form-label-custom">Date Created</td>
                                <td><input type="datetime" class="form-control" id="dateCreatedInput" readonly></td>
                            </tr>
                            <tr>
                                <td class="form-label-custom">Date Completed</td>
                                <td><input type="datetime" class="form-control" id="dateCompletedInput" readonly></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="col">
                    <table class="table form-table">
                        <thead>
                            <tr>
                                <td class="form-label-custom">Subject</td>
                                <td>
                                    <input type="text" name="ticketSubject" id="subjectInput" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td class="form-label-custom">Description</td>
                                <td><textarea name="ticketDescription" id="descriptionInput" class="form-control" cols="30" rows="5"></textarea></td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="block-container" style="margin-top: 30px;">
            <div class="navigation-tabs">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link project-tab active" aria-current="page" href="#">Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link project-tab" href="#">History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link project-tab" href="#">Attachments</a>
                    </li>
                </ul>
            </div>
            <?php
                include 'includes/contents/ticket-notes.html';
            ?>
        </div>
    </div>

    <?php 
        include_once 'includes/modals/project-detail-modals.html';
        include_once 'includes/commons/js-common-includes.html';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="js/ticket-details.js"></script>
</body>
</html>