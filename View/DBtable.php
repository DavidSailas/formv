<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include $_SERVER['DOCUMENT_ROOT'].'/formv/Model/db_connect.php';
include $_SERVER['DOCUMENT_ROOT'].'/formv/Model/getbod.php';
include $_SERVER['DOCUMENT_ROOT'].'/formv/Model/delete.php';

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
    <link rel="stylesheet" href="/formv/Css/style_dbtable.css">
</head>
<body>

<video autoplay muted loop id="bg-video"> 
    <source src="/formv/bg/bgv.mp4" type="video/mp4"> 
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
    <a href="/formv/View/index.php?edit=" id="edit-button" class="edit-button">
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
                    document.getElementById('row-' + id).remove(); 
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
