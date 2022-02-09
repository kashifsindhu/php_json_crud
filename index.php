<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CRUD Operation on JSON File using PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<body>
<div class="container mx-auto mt-5">
    <h3 class="d-inline">CRUD Operation on JSON File using PHP</h3>
    <a class=" d-inline btn btn-primary float-right" href="add.php">Add New Data</a>
    <table class="table table-striped" border="1">
        <thead class="bg-dark text-white text-center">
        <th>ID</th>
        <th>Title</th>
        <th>Image</th>
        <th>Action</th>
        </thead>
        <tbody>
        <?php
        //fetch data from json
        $data = file_get_contents('file.json');
        //decode into php array
        $data = json_decode($data);

        $index = 0;
        if(empty($data)){
            echo "<tr><td colspan='5'>no record found...</td></tr>";
        }else {
            foreach ($data as $row) {
                echo "
					<tr>
						<td>" . $row->id . "</td>
						<td>" . $row->title . "</td>
						<td>" . $row->image . "</td>
						<td>
							<a class='btn btn-warning' href='edit.php?index=" . $index . "'>Edit</a>
							<a class='btn btn-danger' href='delete.php?index=" . $index . "'>Delete</a>
						</td>
					</tr>
				";

                $index++;
            }
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>