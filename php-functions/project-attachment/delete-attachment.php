<?php

require '../../Class/ProjectAttachment.php';

if(isset($_POST)){
    $attachment = new ProjectAttachment;

    $file = $attachment->find($_POST['id']);

    if($attachment->remove($_POST['id'])){
        unlink('../../attachments/'.$file['real_filename']);
        exit(json_encode(['success' => true, 'message' => 'Successfully removed attachment.']));
    }

    exit(json_encode(['success' => false, 'message' => $attachment->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid action!']);