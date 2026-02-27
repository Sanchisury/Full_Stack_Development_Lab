<?php
include 'db.php';

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM student WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $department = $_POST['department'];

    $sql = "UPDATE student SET 
            name='$name',
            email='$email',
            mobile='$mobile',
            department='$department'
            WHERE id=$id";

    mysqli_query($conn, $sql);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to right, #667eea, #764ba2);
    margin: 0;
}

.container {
    width: 50%;
    margin: 80px auto;
}

.card {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 5px 15px rgba(0,0,0,0.2);
}

h2 {
    text-align: center;
}

input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
}

button {
    width: 100%;
    padding: 10px;
    background: orange;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background: darkorange;
}
</style>
</head>

<body>

<div class="container">
    <div class="card">
        <h2>Edit Student</h2>

        <form method="POST">
            <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
            <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
            <input type="text" name="mobile" value="<?php echo $row['mobile']; ?>" required>
            <input type="text" name="department" value="<?php echo $row['department']; ?>" required>

            <button type="submit" name="update">Update Student</button>
        </form>
    </div>
</div>

</body>
</html>