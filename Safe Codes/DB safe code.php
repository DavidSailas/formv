<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formv";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to calculate age from DOB
function calculateAge($dob) {
    $dob = new DateTime($dob);
    $today = new DateTime();
    return $dob->diff($today)->y;
}

// Handle DELETE request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];
    $deleteQuery = "DELETE FROM user_table WHERE user_id = '$user_id'";
    mysqli_query($conn, $deleteQuery);
    echo 'Record deleted successfully'; // Return success message
    exit();
}

// Fetch records from the database
$query = "SELECT user_id, last_name, first_name, middle_name, dob, sex FROM user_table";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Table</title>
<style>

        body {
            font-family: Arial, sans-serif;
            background-color: #000000;
            color: white;
            padding: 2rem;
        }
        #bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw; 
            height: 100vh; 
            object-fit: cover; 
            z-index: -1; 
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            margin: 0 auto;
        }

        .title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(0, 0, 0, 0.5); 
            backdrop-filter: blur(10px); 
            color: white;
            border-radius: 10px;
            overflow: hidden;
        }

        .data-table th, .data-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .data-table th {
            background: rgba(50, 50, 50, 0.8);
            color: white;
        }

        .button-row {
            display: none;
            justify-content: center;
            margin-top: 20px;
            gap: 10px;
        }

        .button-row a, .button-row button {
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .edit-button {
            background-color: #28a745;
            color: white;
            text-decoration: none;
        }

        .edit-button:hover {
            background-color: #218838;
        }

        .delete-button {
            background-color: #dc3545;
            color: white;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

        .button-cancel {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 10px;
        }

        .button-cancel a, .button-cancel button {
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
        }

        .cancel-button {
            background-color:rgb(0, 136, 255);
            color: white;
        }

        .cancel-button:hover {
            background-color:rgb(76, 170, 241);
        }
</style>
</head>
<body>

<video autoplay muted loop id="bg-video"> 
    <source src="bg/bgv.mp4" type="video/mp4"> 
</video>

<div class="container">
    <h1 class="title">Database Table</h1>
    <table class="data-table">
        <thead>
            <tr>
                <th>Select</th>
                <th>Full Name</th>
                <th>Age</th>
                <th>Date of Birth</th>
                <th>Sex</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { 
                $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
                $age = calculateAge($row['dob']);
            ?>
                <tr id="row-<?php echo htmlspecialchars($row['user_id']); ?>">
                    <td><input type="checkbox" name="select_row" value="<?php echo htmlspecialchars($row['user_id']); ?>"></td>
                    <td><?php echo htmlspecialchars($full_name); ?></td>
                    <td><?php echo htmlspecialchars($age); ?></td>
                    <td><?php echo htmlspecialchars($row['dob']); ?></td>
                    <td><?php echo htmlspecialchars($row['sex']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>


<div id="button-row" class="button-row" style="display: none;">
    <a href="index.php?edit=" id="edit-button" class="edit-button">
        <i class="fas fa-edit"></i> Edit
    </a>
    <form method="POST" class="inline" id="delete-form">
        <input type="hidden" name="user_id" id="delete-user-id">
        <button type="submit" name="delete" class="delete-button">
            <i class="fas fa-trash"></i> Delete
        </button>
    </form>
</div>


<div class="button-cancel">
    <a href="index.php" type="button" id="cancel-button" class="cancel-button">
        Cancel
    </a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[name="select_row"]');
    const buttonRow = document.getElementById('button-row');
    const editButton = document.getElementById('edit-button');
    const deleteForm = document.getElementById('delete-form');
    const deleteUserId = document.getElementById('delete-user-id');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const selectedCheckboxes = document.querySelectorAll('input[name="select_row"]:checked');
            const selectedValues = Array.from(selectedCheckboxes).map(cb => cb.value);

            if (selectedValues.length > 0) {
                buttonRow.style.display = 'flex';
                deleteUserId.value = selectedValues.join(',');

                if (selectedValues.length === 1) {
                    editButton.href = 'index.php?edit=' + selectedValues[0];
                    editButton.style.pointerEvents = 'auto';
                    editButton.style.opacity = '1';
                } else {
                    editButton.href = '#';
                    editButton.style.pointerEvents = 'none';
                    editButton.style.opacity = '0.5';
                }
            } else {
                buttonRow.style.display = 'none';
            }
        });
    });

    deleteForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData();
        formData.append('delete', true);
        formData.append('user_ids', deleteUserId.value);

        fetch('', { method: 'POST', body: formData })
        .then(response => response.text())
        .then(message => {
            if (message === 'Records deleted successfully') {
                deleteUserId.value.split(',').forEach(id => {
                    document.getElementById('row-' + id).remove(); // Remove from display
                });
                buttonRow.style.display = 'none';
            } else {
                alert('Error deleting records.');
            }
        });
    });
});
</script>


</body>
</html>
