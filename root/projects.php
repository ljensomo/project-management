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
            $page = 'Projects';
            include_once 'includes/commons/common-includes.php';
        ?>

        <div class="content">
            <div class="content-main block-container">
                <h2>Projects</h2>
                <hr>
                <div class="table-header-buttons">
                    <button type="button" class="btn btn-sm btn-secondary btnCreate" data-bs-toggle="modal" data-bs-target="#projectModal">
                        <i class="fa fa-plus"></i> New Project
                    </button>
                </div>
                <table class="table table-bordered table-hover table-striped" id="projectTable">
                    <thead>
                        <tr>
                            <th>Project ID</th>
                            <th>Project Name</th>
                            <!-- <th>Objective</th> -->
                            <th>Phase</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

    <?php 
        include_once 'includes/modals/project-modals.html';
        include_once 'includes/commons/js-common-includes.html';
    ?>

    <script type="text/javascript" src="js/project.js"></script>
</body>
</html>