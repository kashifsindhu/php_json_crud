<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CRUD Operation on JSON File using PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<body>
<div class="container mx-auto mt-5">
    <form class="form" method="POST">
        <h3 class="d-inline ">Add Data</h3>
        <a class="d-inline btn btn-primary float-right" href="index.php">Back</a>
        <input type="hidden" id="id" name="id" value="<?php echo mt_rand(1, 999999); ?>"/>
        <div class="form-group mt-5">
            <label for="tile">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
        </div>
        <div class="form-group">
            <label for="image">Image :</label>
            <input type="file" class="form-control" id="image" name="image" placeholder="Select image">
        </div>
        <input class="btn btn-success" type="submit" name="save" value="Update">
    </form>
</div>

<?php
if (isset($_POST['save'])) {
    //open the json file
    $data = file_get_contents('file.json');
    $data = json_decode($data);

    //data in out POST
    $input = array(
        'id' => $_POST['id'],
        'title' => $_POST['title'],
        'image' => $_POST['image'],
    );

    //append the input to our array
    $data[] = $input;
    //encode back to json
    $data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('file.json', $data);

    header('location: index.php');
}
?>
</body>
</html>