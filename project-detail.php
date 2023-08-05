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
</head>
<body>
        <?php
            $page = 'Projects';
            include_once 'includes/commons/common-includes.php';
        ?>

        <div class="content">
            <div class="content-main block-container">
                <div class="table-header-columns">
                    <button type="button" class="btn btn-success" id="btnSaveProject"><i class="fa fa-save"></i> Save Changes</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ownerModal"><i class="fa fa-user"></i> Add Project Owner</button>
                    <hr>
                </div>
                <div class="row">
                    <div class="col">
                        <form action="" id="projectForm" class="form-inline">
                            <table class="table form-table">
                                <tr>
                                    <td class="form-label-custom">Project ID</td>
                                    <td><input type="text" name="projectId" id="projectIdInput" value="<?=$_GET['pid']?>" class="form-control" readonly></td>
                                </tr>
                                <tr>
                                    <td class="form-label-custom">Project Name</td>
                                    <td><input type="text" name="projectName" id="projectNameInput" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td class="form-label-custom">Project Description</td>
                                    <td><textarea name="projectDescription" id="projectDescriptionInput" class="form-control" cols="30" rows="5"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="form-label-custom">Date Created</td>
                                    <td><input type="datetime" class="form-control" id="dateCreatedInput" readonly></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="col">
                        <table class="table table-bordered table-hover table-striped" id="ownerTable">
                            <thead>
                                <tr>
                                    <th>Project Owner(s)</th>
                                    <th>Action</th>
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
                            <a class="nav-link active" aria-current="page" href="#">Modules</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                    </ul>
                </div>
                <?php 
                    include 'includes/contents/project-module-tab.html';
                ?>
            </div>
        </div>

    <?php 
        include_once 'includes/modals/project-detail-modals.html';
        include_once 'includes/commons/js-common-includes.html';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script text="text/javascript" src="js/project-detail.js"></script>
    <script text="text/javascript" src="js/project-module.js"></script>
</body>
</html>