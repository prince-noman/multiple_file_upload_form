<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <style>
        body{
            margin-top: 150px;
        }
    </style>
</head>
<body>

<?php

if ( isset( $_POST['submit'] ) ) {

// $fname = $_POST['fname'];
    // $lname = $_POST['lname'];

    $fname = filter_input( INPUT_POST, 'fname', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    $lname = filter_input( INPUT_POST, 'lname', FILTER_SANITIZE_FULL_SPECIAL_CHARS );

    $photoName    = $_FILES['photo']['name'];
    $photoTmpName = $_FILES['photo']['tmp_name'];

    if ( empty( $fname ) || empty( $lname ) ) {
        $msg = 'Please insert your name';
    } else {
        $msg = 'Thanks for submitting the form.';
    }

    $allowedTypes = [
        'image/png',
        'image/jpg',
    ];

    if ( !empty( $photoName ) ) {
        $totalPhoto = count( $photoName );

        for ( $i = 0; $i < $totalPhoto; $i++ ) {

            if ( in_array( $_FILES['photo']['type'][$i], $allowedTypes ) ) {
                move_uploaded_file( $photoTmpName[$i], "./img/" . $photoName[$i] );
            }

        }

    }

}

?>


<div class="container">
    <div class="row">
        <div class="column column-60 column-offset-20">
            <h1 class="h1-primary">Multiple File Upload System</h1>
            <h5><b>This form has Javascript Injection Portection.</b></h5>

<?php

if ( isset( $_POST['submit'] ) ): ?>
<pre><code>
<?php
// print_r( $_POST );
// print_r( $_FILES );
echo $msg ?? '';
echo "First Name:" . $fname . "<br>";
echo "Last Name:" . $lname . "<br>";
?>
</code></pre>
<?php endif;?>
        </div>
    </div>

    <div class="row">
        <div class="column column-60 column-offset-20">
             <form method="POST" enctype="multipart/form-data">

             <label for="fname">First Name</label>
             <input type="text" name="fname" id="">

             <label for="lname">Last Name</label>
             <input type="text" name="lname" id="">

             <label for="">Photo</label>
             <input type="file" name="photo[]"> <br>
             <input type="file" name="photo[]"> <br>
             <input type="file" name="photo[]"> <br>

             <input type="submit" name="submit" value="Submit">

            </form>
        </div>
    </div>

</div>

</body>
</html>