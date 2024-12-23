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
            $page = 'Database';
            include_once 'includes/commons/common-includes.php';
        ?>

        <div class="content">
            <div class="content-main block-container">
                <div class="table-header-buttons">
                    <button type="button" class="btn btn-sm btn-secondary btnGenerate">
                        <i class="fa fa-plus"></i> Generate Backup
                    </button>
                </div>
                <table class="table table-bordered table-hover table-striped" id="databaseTable">
                    <thead>
                        <tr>
                            <th>Filename</th>
                            <th>Date Generated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

    <?php 

        include_once 'includes/commons/js-common-includes.html';
    ?>

    <script type="text/javascript" src="js/database.js"></script>
</body>
</html>