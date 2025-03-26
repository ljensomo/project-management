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
                    <a href="projects.php" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Back to Projects</a>
                    <button type="button" class="btn btn-sm btn-success" id="btnSaveProject"><i class="fa fa-save"></i> Save Changes</button>
                    <button type="button" class="btn btn-sm btn-primary" id="btnUpload"><i class="fa fa-file"></i> Upload</button>
                    <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-ticket"></i> Tickets</a>
                    <hr>
                </div>
                <div class="row">
                    <div class="col">
                        <form action="" id="projectForm" class="form-inline">
                            <input type="hidden" name="create_update_project" value="1">
                            <table class="table form-table">
                                <tr>
                                    <td class="form-label-custom"><label for="" class="form-label">Project ID</label></td>
                                    <td><input type="text" name="project_id" id="projectIdInput" value="<?=$_GET['pid']?>" class="form-control" readonly></td>
                                </tr>
                                <tr>
                                    <td class="form-label-custom"><label for="" class="form-label">Project Name</label></td>
                                    <td><input type="text" name="project_name" id="projectNameInput" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td class="form-label-custom"><label for="" class="form-label">Phase</label></td>
                                    <td>
                                        <select name="phase" id="phaseSelect" class="form-control" required>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="form-label-custom"><label for="" class="form-label">Status</label></td>
                                    <td>
                                        <select class="form-control" name="status" id="statusSelect" required>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="form-label-custom"><label for="" class="form-label">Created By/Requestor</label></td>
                                    <td><input type="text" class="form-control" id="createdByInput" readonly></td>
                                </tr>
                                <tr>
                                    <td class="form-label-custom"><label for="" class="form-label">Date Created</label></td>
                                    <td><input type="datetime" class="form-control" id="dateCreatedInput" readonly></td>
                                </tr>
                                <tr>
                                    <td class="form-label-custom"><label for="" class="form-label">Assigned Group</label></td>
                                    <td>
                                        <select name="" class="form-control" id=""></select>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="col">
                        <table class="table table-bordered table-hover table-striped" id="overviewTable">
                            <thead>
                                <tr>
                                    <th>Phase</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="block-container">
                <div class="navigation-tabs">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active project-tab" aria-current="page" href="#">Notes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link project-tab" aria-current="page" href="#">Tasks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link project-tab" href="#">Attachments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link project-tab" href="#">Schedule</a>
                        </li>
                    </ul>
                </div>
                <?php 
                    include 'includes/contents/project-tabs.html';
                ?>
            </div>
        </div>

    <?php 
        include_once 'includes/modals/project-detail-modals.html';
        include_once 'includes/commons/js-common-includes.html';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/dataRender/ellipsis.js"></script>

    <script text="text/javascript" src="js/project-detail.js"></script>
    <script text="text/javascript" src="js/project-tasks.js"></script>
    <script text="text/javascript" src="js/project-phase.js"></script>
</body>
</html>