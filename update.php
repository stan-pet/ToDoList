<?php

require_once "config/Database.php";

$title = $description = "";
$title_err = $description_err = "";

if (isset($_POST["id"]) && !empty($_POST["id"]))
{
    $id = $_POST["id"];
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);

    if ($title && $description)
    {
        $sql = "UPDATE tasks SET title=:title, description=:description, date_created=:date_created WHERE id=:id";

        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":title", $param_title);
            $stmt->bindParam(":description", $param_description);
            $stmt->bindParam(":date_created", $param_date_created);
            $stmt->bindParam(":id", $param_id);

            $param_title = $title;
            $param_description = $description;
            $param_date_created = date('Y-m-d H:i:s');
            $param_id = $id;

            if ($stmt->execute())
            {
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        unset($stmt);
    }
    unset($pdo);
} else{

    if (isset($_GET["id"]) && !empty(trim($_GET["id"])))
    {
        $id =  trim($_GET["id"]);
        $sql = "SELECT * FROM tasks WHERE id = :id";

        if ($stmt = $pdo->prepare($sql))
        {
            $stmt->bindParam(":id", $param_id);
            $param_id = $id;

            if ($stmt->execute())
            {
                if ($stmt->rowCount() == 1)
                {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $title = $row["title"];
                    $description = $row["description"];
                    $date_created = $row["date_created"];
                } else {
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        unset($stmt);
        unset($pdo);
    }  else {
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Update Record</h2>
                <p>Please edit the input values and submit to update the task record.</p>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                        <span class="invalid-feedback"><?php echo $title_err;?></span>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                        <span class="invalid-feedback"><?php echo $description_err;?></span>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>