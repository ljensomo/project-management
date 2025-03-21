<?php

session_start();

require '../../Class/ProjectAttachment.php';

if($_POST){
    $attachment = new ProjectAttachment;

    $filename = $_FILES['file']['name'];
    $real_filename = uniqid(). '.' .pathinfo($filename,PATHINFO_EXTENSION);
    $target_file = "../../attachments/" . $real_filename;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

        $attachment->setProjectId($_POST['project_id']);
        $attachment->setFilename($filename);
        $attachment->setRealFilename($real_filename);
        $attachment->setAddedBy($_SESSION['user_id']);
        
        if($attachment->create()){
            exit(json_encode(['success' => true, 'message' => 'Successfully added attachment.']));
        }
    
        exit(json_encode(['success' => false, 'message' => $attachment->getErrorMessage()]));
    } else {
        exit(json_encode(['success' => false, 'message' => 'Error uploading the file.']));
    }

}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);