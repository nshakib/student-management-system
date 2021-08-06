<?php include "inc/header.php";?>
<?php include "lib/Student.php";?>

<div class="card bg-primary text-white">
    <div class="card-body">
        <h4 class="card-title text-center">Students Attendance System</h4>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">
            <a class="btn btn-primary" href="add.php">Add Students</a>
            <a class="btn btn-info float-right" href="index.php">Take Attendance</a>
        </h2>
    </div>
    <div class="card-body">
        <div class="card bg-secondary text-white text-center">
            <div class="card-header" style="font-size: 20px;">
                <strong>Date: 
                    <?php 
                        $cur_date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                        echo $cur_date->format('F j, Y, g:i a');
                    ?>
                </strong>
            </div>
        </div>
        <form action="" method="POST">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Attendance Date</th>
                        <th>Action</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                        $stu = new Student();
                        $get_date = $stu->getDateList();
                        if($get_date)
                        {
                            $i= 0;
                            while($result=$get_date->fetch_assoc()){
                            $i++;
                            ?>

                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['attend_time']; ?></td>
                        <td>
                            <a class="btn btn-primary" href="student_view.php?dt=<?php echo $result['attend_time']; ?>">View</a>
                        </td>
                    </tr>
                    <?php }}?>

                </tbody>
            </table>
        </form>
    </div>
</div>


<?php include "inc/footer.php";?>