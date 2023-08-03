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
            $page = 'Users';
            include_once 'includes/commons/common-includes.php';
        ?>

        <div class="content">
            <div class="content-main block-container">
                <div class="table-header-buttons">
                    <button type="button" class="btn btn-success btnCreate" data-bs-toggle="modal" data-bs-target="#userModal">
                        <i class="fa fa-plus"></i> Create New
                    </button>
                </div>
                <table class="table table-bordered table-hover table-striped" id="userTable">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

    <?php 
        include_once 'includes/modals/user-modals.html';
        include_once 'includes/commons/js-common-includes.html';
    ?>
    <script type="text/javascript" src="js/user.js"></script>
</body>
</html>