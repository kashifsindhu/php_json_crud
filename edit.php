<?php
//get the index from URL
$index = $_GET['index'];

//get json data
$data = file_get_contents('file.json');
$data_array = json_decode($data);

//assign the data to selected index
$row = $data_array[$index];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CRUD Operation on JSON File using PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mx-auto mt-5">
    <h3 class="d-inline ">Edit Data</h3>
    <a class="d-inline btn btn-primary float-right" href="index.php">Back</a>
    <form class="form" method="POST">
        <input type="hidden" value="<?php echo mt_rand(1, 999999); ?>" id="id" name="id"/>

        <div class="form-group mt-5">
            <label for="tile">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"
                   value="<?php echo $row->title; ?>">
        </div>

        <div class="form-group">
            <label for="image">Image : ( <?php echo $row->image; ?> )</label>
            <input type="file" class="form-control" id="image" name="image" placeholder="Select image">
            <input type="hidden" class="form-control" id="image_hidden" name="image_hidden" placeholder="Select image"
                   value="<?php echo $row->image; ?>">
        </div>
        <input class="btn btn-success" type="submit" name="save" value="Update">
    </form>
</div>
<?php
if (isset($_POST['save'])) {
    //set the updated values
    if(empty($_POST['image'])) {
        $image = $_POST['image_hidden'];
    } else {
        $image = $_POST['image'];
        var_dump($image);
    }
    $input = array(
        'id' => $_POST['id'],
        'title' => $_POST['title'],
        'image' => $image,
    );

    //update the selected index
    $data_array[$index] = $input;

    //encode back to json
    $data = json_encode($data_array, JSON_PRETTY_PRINT);
    file_put_contents('file.json', $data);

    header('location: index.php');
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(function () {
        $(":file").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

    function imageIsLoaded(e) {
        $('#myImg').attr('src', e.target.result);
    };
    // CHARACTERS COUNTER
    $(".counter").keyup(function (e) {
        var length = $(this).val().length;
        var maxlength = $(this).attr("maxlength");
        var form = $(this).closest('form').attr('id');
        $(this).next().text(length + "/" + maxlength);
        if (length >= maxlength - 3) {
            // $(`#${form}`).find("button").attr('disabled', true);
            $(this).next().addClass("text-danger");
        } else {
            // $(`#${form}`).find("button").attr('disabled', false);
            $(this).next().removeClass("text-danger");

        }
    });
</script>
</body>
</html>