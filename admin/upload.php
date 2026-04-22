<?php

if(isset($_FILES['file'])){

    $file = $_FILES['file'];

    $filename = $file['name'];
    $tmp = $file['tmp_name'];

    // Allowed extensions
    $allowed = ['jpg','jpeg','png','gif','webp'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if(!in_array($ext, $allowed)){
        http_response_code(400);
        echo json_encode(['error' => 'Invalid file type']);
        exit;
    }

    // Rename file
    $newName = time() . "_" . $filename;

    // Upload path (IMPORTANT)
   $uploadPath = "assets/uploads/" . $newName;

if(move_uploaded_file($tmp, $uploadPath)){
    echo json_encode([
        "location" => "assets/uploads/" . $newName
    ]);
}else {
    http_response_code(500);
    echo json_encode(['error' => 'Upload failed']);
}
}
?>