<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc

// if ($_GET == NULL) {
//   $uname = $_SESSION['uname'];
// } else {
//   $uname = $_GET['un'];
// }
$uname = $_SESSION['extra'];
$trainer = $_SESSION['uname'];
$showuname = $_SESSION['uname'];
$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());

if (!$conn) {
  echo "sorry";
} else {
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $sql1 = "Select Diet_Id from Member where username='$uname'";
    $stid1 = oci_parse($conn, $sql1);
    $r1 = oci_execute($stid1);
    $mem = oci_fetch_array($stid1, OCI_ASSOC + OCI_RETURN_NULLS);
   
    
    // if (isset($_POST['breakfast_vitamin']) && isset($_POST['breakfast_protein']) &&  isset($_POST['breakfast_carbohydrate']) && isset($_POST['breakfast_minerals']) && isset($_POST['breakfast_fat']) && isset($_POST['breakfast_calory'])  &&   isset($_POST['lunch_vitamin']) && isset($_POST['lunch_protein']) &&  isset($_POST['lunch_carbohydrate']) && isset($_POST['lunch_minerals']) && isset($_POST['lunch_fat']) && isset($_POST['lunch_calory'])  &&   isset($_POST['dinner_vitamin']) && isset($_POST['dinner_protein']) &&  isset($_POST['dinner_carbohydrate']) && isset($_POST['dinner_minerals']) && isset($_POST['dinner_fat']) && isset($_POST['dinner_calory']) &&  isset($_POST['pre_wrk_protein']) &&  isset($_POST['pre_wrk_carbohydrate']) &&  isset($_POST['pre_wrk_calory']) &&  isset($_POST['post_wrk_protein']) &&  isset($_POST['post_wrk_carbohydrate']) &&  isset($_POST['post_wrk_calory'])) 
    // {
      
      $_SESSION['xxx'] = $mem;
      if($mem['DIET_ID'] == NULL)
      {
        //$diet_id=$diet_id+1;
        $sql="select * from diet_chart order by diet_id desc";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
        $diet_id = $row['DIET_ID']+1;
        
        $b_vitamin = $_POST['breakfast_vitamin'];
        // $sql="insert into diet_chart (diet_id) values ($diet_id)";
        // $stid = oci_parse($conn, $sql);
        // $r = oci_execute($stid);

        $b_protein = $_POST['breakfast_protein'];
        $b_carbohydrate = $_POST['breakfast_carbohydrate'];
        $b_minerals = $_POST['breakfast_minerals'];
        $b_fat = $_POST['breakfast_fat'];
        $b_calory = $_POST['breakfast_calory'];

        $l_vitamin = $_POST['lunch_vitamin'];
        $l_protein = $_POST['lunch_protein'];
        $l_carbohydrate = $_POST['lunch_carbohydrate'];
        $l_minerals = $_POST['lunch_minerals'];
        $l_fat = $_POST['lunch_fat'];
        $l_calory = $_POST['lunch_calory'];

        $d_vitamin = $_POST['dinner_vitamin'];
        $d_protein = $_POST['dinner_protein'];
        $d_carbohydrate = $_POST['dinner_carbohydrate'];
        $d_minerals = $_POST['dinner_minerals'];
        $d_fat = $_POST['dinner_fat'];
        $d_calory = $_POST['dinner_calory'];

        $pr_wrk_protein = $_POST['pre_wrk_protein'];
        $pr_wrk_carbohydrate = $_POST['pre_wrk_carbohydrate'];
        $pr_wrk_calory = $_POST['pre_wrk_calory'];

        $po_wrk_protein = $_POST['post_wrk_protein'];
        $po_wrk_carbohydrate = $_POST['post_wrk_carbohydrate'];
        $po_wrk_calory = $_POST['post_wrk_calory'];

        $sql = "insert into diet_chart (DIET_ID,B_VITAMIN,B_FAT,B_PROTEIN,B_MINERALS,B_CARBOHYDRATE,B_CALORIES,
          L_VITAMIN,L_FAT,L_PROTEIN,L_MINERALS,L_CARBOHYDRATE,L_CALORIES,
          D_VITAMIN,D_FAT,D_PROTEIN,D_MINERALS,D_CARBOHYDRATE,D_CALORIES,
          PR_WRK_CARBOHYDRATE,PR_WRK_PROTEIN,PR_WRK_CALORIES,
          PST_WRK_CARBOHYDRATE,PST_WRK_PROTEIN,PST_WRK_CALORIES) values(DIET_ID_GENERATE_SEQUENCE.NEXTVAL, '$b_vitamin', '$b_fat', '$b_protein', '$b_minerals','$b_carbohydrate','$b_calory','$l_vitamin', '$l_fat', '$l_protein', '$l_minerals','$l_carbohydrate','$l_calory','$d_vitamin', '$d_fat', '$d_protein', '$d_minerals','$d_carbohydrate','$d_calory','$pr_wrk_protein','$pr_wrk_carbohydrate','$pr_wrk_calory','$po_wrk_protein','$po_wrk_carbohydrate','$po_wrk_calory')";

          
        
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);



        $update = "update member set diet_id = DIET_ID_GENERATE_SEQUENCE.CURRVAL where username='$uname'";
        $stmt = oci_parse($conn, $update);
        $result = oci_execute($stmt);     


        $diet_id=$mem['DIET_ID'];
        $trig="CREATE or REPLACE TRIGGER FIXED_BY_TRAINER_TRIGGER
        AFTER UPDATE OF DIET_ID
        ON MEMBER
        FOR EACH ROW
        DECLARE 
        v varchar2(12);
        f varchar2(52);
        BEGIN
        dbms_output.put_line('trigger called');
        v := 'Inserted';
        select TO_CHAR(SYSDATE, 'HH:MI:SS AM')  into f from dual;

        INSERT INTO Fixed_By_Trainer VALUES (Action_NO_SEQ.nextval,:new.Trainer,:new.Username,:new.Diet_Id, SYSDATE,f,v);
        END;
        ";
        $stid=oci_parse($conn,$trig);
        $r=oci_execute($stid);
      }

      else
      {
        $diet_id=$mem['DIET_ID'];
        $b_vitamin = $_POST['breakfast_vitamin'];
        $b_protein = $_POST['breakfast_protein'];
        $b_carbohydrate = $_POST['breakfast_carbohydrate'];
        $b_minerals = $_POST['breakfast_minerals'];
        $b_fat = $_POST['breakfast_fat'];
        $b_calory = $_POST['breakfast_calory'];
        $l_vitamin = $_POST['lunch_vitamin'];
        $l_protein = $_POST['lunch_protein'];
        $l_carbohydrate = $_POST['lunch_carbohydrate'];
        $l_minerals = $_POST['lunch_minerals'];
        $l_fat = $_POST['lunch_fat'];
        $l_calory = $_POST['lunch_calory'];
        $d_vitamin = $_POST['dinner_vitamin'];
        $d_protein = $_POST['dinner_protein'];
        $d_carbohydrate = $_POST['dinner_carbohydrate'];
        $d_minerals = $_POST['dinner_minerals'];
        $d_fat = $_POST['dinner_fat'];
        $d_calory = $_POST['dinner_calory'];
        $pr_wrk_protein = $_POST['pre_wrk_protein'];
        $pr_wrk_carbohydrate = $_POST['pre_wrk_carbohydrate'];
        $pr_wrk_calory = $_POST['pre_wrk_calory'];

        $po_wrk_protein = $_POST['post_wrk_protein'];
        $po_wrk_carbohydrate = $_POST['post_wrk_carbohydrate'];
        $po_wrk_calory = $_POST['post_wrk_calory'];
        $_SESSION['xxx'] = $b_calory;
        $sql = "update diet_chart set b_vitamin = $b_vitamin, b_fat = $b_fat, b_protein = $b_protein, b_carbohydrate= $b_carbohydrate, b_minerals = $b_minerals, b_calories = $b_calory, l_vitamin = $l_vitamin, l_protein = $l_protein, l_carbohydrate = $l_carbohydrate, l_minerals = $l_minerals, l_fat = $l_fat, l_calories = $l_calory, d_vitamin = $d_vitamin, d_protein = $d_protein, d_carbohydrate = $d_carbohydrate, d_minerals = $d_minerals, d_fat = $d_fat, d_calories = $d_calory, pr_wrk_protein = $pr_wrk_protein, pr_wrk_carbohydrate = $pr_wrk_carbohydrate, pr_wrk_calories = $pr_wrk_calory, pst_wrk_protein = $po_wrk_protein, pst_wrk_carbohydrate = $po_wrk_carbohydrate, pst_wrk_calories = $po_wrk_calory  where diet_id = $diet_id";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        


        // $trig="CREATE or REPLACE TRIGGER FIXED_BY_TRAINER_TRIGGER
        // AFTER UPDATE OF DIET_ID
        // ON DIET_CHART
        // FOR EACH ROW
        // DECLARE 
        // v varchar2(12);
        // f varchar2(52);
        // user varchar2(52);
        // tra varchar2(52);
        // diet number;
        // BEGIN
        // dbms_output.put_line('trigger called');
        // v := 'Updated';
        // diet := :old.diet_id;
        // select TO_CHAR(SYSDATE, 'HH:MI:SS AM')  into f from dual;
        // select username into user from member where diet_id=diet;
        // select trainer into tra from member where diet_id=diet;

        // INSERT INTO Fixed_By_Trainer VALUES (Action_NO_SEQ.nextval,tra,user,diet, SYSDATE,'f','v');
        // END;
        // ";
        // $stid=oci_parse($conn,$trig);
        // $r=oci_execute($stid);
        

      }
    

    // }
  
  header("location: diet.php?un=$uname");
  //exit;
  

  }



  
}
