<?php include "inc/header.php";?>
<?php include "lib/Student.php";?>

<script type="text/javascript">
    $(document).ready(function(){
        $("form").submit(function(){
            var roll = true;
            $(':radio').each(function(){
                name = $(this).attr('name');
                if(roll && !$(':radio[name="' + name +'"]:checked').length){
                    // alert(name + " Roll Missing!");
                    $('.alert').show();
                    roll = false;
                }
            });
            return roll;
        });
    });
</script>

<?php
    // error_reporting(0);
    $stu = new Student();
    $cur_date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    date_default_timezone_set('Asia/Dhaka');
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
    {
        if (empty($_POST['attend'])) {
        
            $msg = '<div class="alert alert-danger">Field must not be Empty!</div>';
                 
          }else{

            $attend = $_POST['attend'];
            $msg =$stu->insertAttendance($attend);
          }
    }
?>
<!-- get date -->
<?php 
    if (isset($_GET['dt']) && $_GET['dt']) {
    $dt = $_GET['dt'];
    }
?>


<?php 
    if(isset($msg))
    {
        echo $msg;
    }
?>
<div class='alert alert-danger' style="display: none;"><strong>Danger!</strong>  Student Roll Missing !</div>
<div class="card bg-primary text-white">
    <div class="card-body">
        <h4 class="card-title text-center">Students Attendance System</h4>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">
            <a class="btn btn-primary" href="add.php">Add Students</a>
            <a class="btn btn-info float-right" href="date_view.php">View All</a>
        </h2>
    </div>
    <div class="card-body">
        <div class="card bg-secondary text-white text-center">
            <div class="card-header" style="font-size: 20px;">
                <strong>Date: 
                    <?php echo $cur_date->format('F j, Y, g:i a');?>
                </strong>
            </div>
        </div>
        <form action="" method="POST">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Student Name</th>
                        <th>Student Roll</th>
                        <th>Attendance</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                        $getStudents = $stu->getStudents();
                        if($getStudents)
                        {
                            $i= 0;
                            while($result=$getStudents->fetch_assoc()){
                            $i++;
                            ?>

                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['name']; ?></td>
                        <td><?php echo $result['roll']; ?></td>
                        <td>
                            <input type="radio" name="attend[<?php echo $result['roll'];?>]" value="present"> P
                            <input type="radio" name="attend[<?php echo $result['roll'];?>]" value="absent"> A
                        </td>
                    </tr>
                    <?php }}?>
                    <tr>
                        <td>
                            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        </td>
                    </tr>

                </tbody>
            </table>
        </form>
    </div>
</div>


<?php include "inc/footer.php";?>