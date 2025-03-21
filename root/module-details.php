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
                    <a href="project-details.php?pid=<?=$_GET['pid']?>" class="btn btn-secondary" id="btnSaveProject"><i class="fa fa-arrow-left"></i> Back to Project</a>
                    <button type="button" class="btn btn-success" id="btnSaveModule"><i class="fa fa-save"></i> Save Changes</button>
                    <hr>
                </div>
                <div class="row">
                    <div class="col">
                        <form action="" id="moduleForm" class="form-inline">
                            <table class="table form-table">
                                <tr>
                                    <td class="form-label-custom">Module ID</td>
                                    <td><input type="text" name="moduleId" id="moduleIdInput" value="<?=$_GET['mid']?>" class="form-control" readonly></td>
                                </tr>
                                <tr>
                                    <td class="form-label-custom">Module Name</td>
                                    <td><input type="text" name="moduleName" id="moduleNameInput" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td class="form-label-custom">Module Description</td>
                                    <td><textarea name="moduleDescription" id="moduleDescriptionInput" class="form-control" cols="30" rows="5"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="form-label-custom">Date Created</td>
                                    <td><input type="datetime" class="form-control" id="dateCreatedInput" readonly></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="col">
                        <table class="table form-table">
                            <tr>
                                <td class="form-label-custom">Project ID</td>
                                <td><input type="text" name="projectId" id="projectIdInput" value="<?=$_GET['pid']?>" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <td class="form-label-custom">Project Name</td>
                                <td><input type="text" name="projectName" id="projectNameInput" class="form-control" readonly></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="navigation-tabs">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Functions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tickets</a>
                        </li>
                    </ul>
                </div>
                    <?php 
                        include 'includes/contents/module-functions-tab.html';
                        include 'includes/modals/module-details-modals.html';
                    ?>
                </div>
        </div>

    <?php 
        include_once 'includes/commons/js-common-includes.html';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script text="text/javascript" src="js/module-detail.js"></script>
</body>
</html>