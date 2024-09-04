<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("config.php");

// Get the property ID from the URL
$property_id = isset($_GET['pid']) ? intval($_GET['pid']) : 0;

// Fetch property details
$property_query = mysqli_query($con, "SELECT * FROM property WHERE pid = $property_id");
$property = mysqli_fetch_assoc($property_query);

// Fetch leads for the property
$leads_query = mysqli_query($con, "SELECT * FROM property_leads WHERE property_id = $property_id");

// Close the database connection
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta Tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Real Estate PHP">
    <meta name="keywords" content="">
    <meta name="author" content="Unicoder">
    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

    <!-- CSS Links -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Muli', sans-serif;
            background-color: #f4f7f6;
        }
        .container {
            background: #fff;
            padding: 30px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .property-info {
            display: flex;
            margin-bottom: 30px;
        }
        .property-info img {
            max-width: 300px;
            border-radius: 8px;
            margin-right: 20px;
        }
        .property-info h2 {
            margin-top: 0;
        }
        .property-info p {
            font-size: 16px;
            line-height: 1.6;
        }
        .leads-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .leads-table th, .leads-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .leads-table th {
            background-color: #f8f8f8;
            color: #333;
        }
        .leads-table tr:hover {
            background-color: #f1f1f1;
        }
        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>

    <!-- Title -->
    <title>Property Leads</title>
</head>
<body>

<div class="container">
    <h1>Property Leads for "<?php echo htmlspecialchars($property['title']); ?>"</h1>

    <div class="property-info">
        <img src="admin/property/<?php echo htmlspecialchars($property['pimage']); ?>" alt="Property Image">
        <div>
            <h2><?php echo htmlspecialchars($property['title']); ?></h2>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($property['location']); ?></p>
            <p><strong>Price:</strong> ₹<?php echo htmlspecialchars($property['price']); ?></p>
            <p><strong>Size:</strong> <?php echo htmlspecialchars($property['size']); ?> Sqft</p>
        </div>
    </div>

    <h2>Leads Information</h2>
    <table class="leads-table">
        <thead>
            <tr>
                <th>Contact Name</th>
                <th>Contact Email</th>
                <th>Contact Phone</th>
                <!--<th>Submission Date</th>-->
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($leads_query) > 0): ?>
                <?php while ($lead = mysqli_fetch_assoc($leads_query)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($lead['contact_name']); ?></td>
                    <td><?php echo htmlspecialchars($lead['contact_email']); ?></td>
                    <td><?php echo htmlspecialchars($lead['contact_phone']); ?></td>
                    <td><?php #echo date('d-m-Y H:i:s', strtotime($lead['submission_date'])); ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No leads found for this property.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="agentproperty.php" class="btn-back">Back to Properties</a>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
