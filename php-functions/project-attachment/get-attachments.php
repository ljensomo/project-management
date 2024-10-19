<?php

require '../../Class/ProjectAttachment.php';

if(isset($_GET)){
    $attachments = new ProjectAttachment;
    $attachments->setProjectId($_GET['id']);
    $data = $attachments->getByProject();
    
    echo json_encode(['data' => $data]);
}