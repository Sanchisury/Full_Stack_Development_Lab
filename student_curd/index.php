<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $department = $_POST['department'];

    $sql = "INSERT INTO student (name, email, mobile, department)
            VALUES ('$name', '$email', '$mobile', '$department')";
    mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #667eea, #764ba2);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 40px auto;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.2);
            margin-bottom: 30px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form input {
            width: 48%;
            padding: 10px;
            margin: 10px 1%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #667eea;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #5a67d8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background-color: #667eea;
            color: white;
            padding: 10px;
        }

        table td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        table tr:hover {
            background-color: #f2f2f2;
        }

        .edit-btn {
            padding: 5px 10px;
            background-color: orange;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .delete-btn {
            padding: 5px 10px;
            background-color: red;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .edit-btn:hover {
            background-color: darkorange;
        }

        .delete-btn:hover {
            background-color: darkred;
        }
    </style>

</head>
<body>

<div class="container">

    <div class="card">
        <h2>Add Student</h2>

        <form method="POST">
            <input type="text" name="name" placeholder="Enter Name" required>
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="text" name="mobile" placeholder="Enter Mobile" required>
            <input type="text" name="department" placeholder="Enter Department" required>

            <button type="submit" name="submit">Add Student</button>
        </form>
    </div>

    <div class="card">
        <h2>Student Records</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Department</th>
                <th>Action</th>
            </tr>

            <?php
            $result = mysqli_query($conn, "SELECT * FROM student");
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['mobile']; ?></td>
                <td><?php echo $row['department']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" 
                       class="delete-btn"
                       onclick="return confirm('Are you sure?');">
                       Delete
                    </a>
                </td>
            </tr>
            <?php } ?>
        </table>

    </div>

</div>

</body>
</html>