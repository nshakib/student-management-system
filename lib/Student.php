<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/Database.php");

class Student{
    
    private $db;
    public function __construct()
    {
        $this->db= new Database(); 
    }

    //
    public function getStudents()
    {
        $query = "SELECT * FROM tbl_students";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertStudent($name, $roll)
    {
        $name = mysqli_real_escape_string($this->db->link, $name);
        $roll = mysqli_real_escape_string($this->db->link, $roll);

        if($name =="" || $roll== "")
        {
            $msg= "<div class='alert alert-danger'>
                        <strong>Danger!</strong>  This alert box indicates a dangerous or potentially negative action.
                    </div>";
            return $msg;
        }else{
            $query = "INSERT INTO tbl_students(name, roll) values('$name','$roll')";
            $insert = $this->db->insert($query);
            // $insert->bind_param($name, $roll);

            $att_query = "INSERT INTO tbl_attendance (roll) values('$roll')";
            $insert = $this->db->insert($att_query);
            // $insert->bind_param($name, $roll);

            if($insert)
            {
                $msg= "<div class='alert alert-success'>
                            <strong>Success!</strong> Student Data Inserted Successfully
                    </div>";
                return $msg;
                
            }else{
                $msg= "<div class='alert alert-danger'>
                        <strong>Danger!</strong>  Student Data Not Inserted Successfully
                    </div>";
                return $msg;
            }
        }
    }

    public function insertAttendance($attend = array())
    {
        // error_reporting(0);
        date_default_timezone_set('Asia/Dhaka');
        $dateTime  = date('Y-m-d');

        $query = "SELECT DISTINCT attend_time FROM tbl_attendance";
        $getData = $this->db->select($query);

        if(!empty($getData)){
            while($result = $getData->fetch_assoc())
            {
                $db_date = $result['attend_time'];

                if($db_date == $dateTime)
                {
                    $msg= "<div class='alert alert-danger'>
                            <strong>Danger!</strong> Attendance already taken
                        </div>";
                    return $msg;
                }
            }
        }

        foreach($attend as $att_key => $att_value)
        {
            if (empty($att_value)) {
        		$msg = '<div class="alert alert-danger"><strong>Error!</strong> Somethine one Messing.</div>';
        	    return $msg;
        	}else{
                    if($att_value == "present")
                    {
                        $stu_query = "INSERT INTO tbl_attendance(roll,attend,attend_time) values('$att_key','present',now())";
                        $data_insert = $this->db->insert($stu_query);
                    }
                
                    elseif($att_value == "absent"){
                        $stu_query = "INSERT INTO tbl_attendance(roll,attend,attend_time) values('$att_key', 'absent' ,now())";
                        $data_insert = $this->db->insert($stu_query);
                }  
            } 
        }
        if(!empty($data_insert))
            {
                $msg= "<div class='alert alert-success'>
                            <strong>Success!</strong> Attendence Data Inserted Successfully
                    </div>";
                return $msg;
                
            }else{
                $msg= "<div class='alert alert-danger'>
                        <strong>Danger!</strong>  Attendence Data Not Inserted !
                    </div>";
                return $msg;
            } 
    }

    public function getDateList()
    {
        $query = "SELECT DISTINCT attend_time FROM tbl_attendance";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAllData($dt)
    {
        $query = "SELECT tbl_students.name, tbl_attendance.*
                 FROM tbl_students INNER JOIN tbl_attendance
                 ON tbl_students.roll = tbl_attendance.roll
                 where attend_time= '$dt'";
        $result = $this->db->select($query);
        return $result;
    }

    public function UpdateAttendance($dt, $attend)
    {
        foreach($attend as $att_key => $att_value)
        {
            if (empty($att_value)) {
        		$msg = '<div class="alert alert-danger"><strong>Error!</strong> Somethine one Messing.</div>';
        	    return $msg;
        	}else{
                    if($att_value == "present")
                    {
                        $query = "UPDATE tbl_attendance set attend='present' where roll='$att_key' AND attend_time='$dt'";
                        $data_update = $this->db->insert($query);
                    }
                
                    elseif($att_value == "absent"){
                        $query = "UPDATE tbl_attendance set attend='absent' where roll='$att_key' AND attend_time='$dt'";
                        $data_update = $this->db->insert($query);
                }  
            } 
        }

        if(!empty($data_update))
            {
                $msg= "<div class='alert alert-success'>
                            <strong>Success!</strong> Attendence Data Update Successfully
                    </div>";
                return $msg;
                
            }else{
                $msg= "<div class='alert alert-danger'>
                        <strong>Danger!</strong>  Attendence Data Not Updated!
                    </div>";
                return $msg;
            } 
    }
}
?>