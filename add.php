<?php 
    include "inc/header.php";
    include "lib/Student.php";
    
?>
<?php 
    $stu = new Student();
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $name = $_POST['name'];
        $roll = $_POST['roll'];

        $insertData =$stu->insertStudent($name,$roll);
    }
?>
<div class="card bg-primary text-white">
    <div class="card-body">
        <h4 class="card-title text-center">Students Attendance System</h4>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">
            <a class="btn btn-primary" href="add.php">Add Students</a>
            <a class="btn btn-info float-right" href="index.php">Back</a>
        </h2>
    </div>
    <?php
    if(isset($insertData))
    {
        echo $insertData;   
    }

    ?>
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Student Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="roll">Student Roll</label>
                <input type="text" name="roll" id="roll" class="form-control" placeholder="Enter Roll">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            </div>

        </form>
    </div>
</div>


<?php include "inc/footer.php";?>