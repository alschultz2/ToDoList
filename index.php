
<?php 
//Adam Schultz
//2/22/2023
	$errors = "";
	$db = mysqli_connect("localhost", "root", "", "todolist");
	if (isset($_POST['submit'])) {
		if (empty($_POST['Title']) || empty($_POST['Description'])) {
			$errors = "You must fill in the Table";
		}else{
			$Title = $_POST['Title'];
			$sql = "INSERT INTO todoitems (Title) VALUES ('$Title')";
            $Description = $_POST['Description'];
			$sqm = "INSERT INTO todoitems (Description) VALUES ('$Description')";
			mysqli_query($db, $sql) & mysqli_query($db, $sqm);
			header('location: index.php');
//I cannot figure out how to make it so that it takes both inputs and puts them on the same line instead of two lines
		}
	}	
    if (isset($_GET['del_Title'])) {
        $ItemNum = $_GET['del_Title'];
        mysqli_query($db, "DELETE FROM todoitems WHERE ItemNum=".$ItemNum);
        header('location: index.php');
    }
    ?>

<!DOCTYPE html>
<html>
<head>
	<title>ToDo List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="heading">
		<h2 style="font-style: 'Hervetica';">ToDo List</h2>
	</div>
	<form method="post" action="index.php" class="input_form">
		<input type="text" name="Title" class="Title_input">
        <input type="text" name="Description" class="Description_input">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Item</button>
	</form>
    <table>
	<thead>
		<tr>
			<th>ItemNum</th>
			<th>Title</th>
            <th>Description</th>
			<th style="width: 60px;">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$todoitems = mysqli_query($db, "SELECT * FROM todoitems");
		$i = 1; while ($row = mysqli_fetch_array($todoitems)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td class="Title"> <?php echo $row['Title']; ?> </td>
                <td class="Description"> <?php echo $row['Description']; ?> </td>
				<td class="delete"> 
					<a href="index.php?del_Title=<?php echo $row['ItemNum'] ?>">x</a> 
				</td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
</table>

    <?php if (isset($errors)) { ?>
        <p><?php echo $errors; ?></p>
    <?php } ?>
</body>
</html>