<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $property_id = $_POST['pid'];
    $user_id = $_POST['uid'];
    $contact_name = $_POST['uname'];
    $contact_email = $_POST['uemail'];
    $contact_phone = $_POST['uphone'];

    if (!empty($property_id) && !empty($user_id) && !empty($contact_name) && !empty($contact_email) && !empty($contact_phone)) {
        $query = "INSERT INTO property_leads (property_id, user_id, contact_name, contact_email, contact_phone) 
                  VALUES ('$property_id', '$user_id', '$contact_name', '$contact_email', '$contact_phone')";

        if (mysqli_query($con, $query)) {
            echo "<script type='text/javascript'>
                    alert('Your enquiry was submitted successfully!');
                    window.location.href = 'propertydetail.php?pid=$property_id';
                  </script>";
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($con);
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request.";
}

mysqli_close($con);
?>
