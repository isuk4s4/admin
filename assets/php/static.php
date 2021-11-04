<?php 

                
if(isset($_SESSION['login'])){
 
?>

<div class="cards">
    <div class="card"><div class="flex"><div class="bgcard first"><i class='bx bx-food-menu'></i></div><div class="textcard">
  <center>  totoal foods<div class="subtext">
  <?php 
 $totoalfosds = "SELECT * FROM `foods`";
 $totoalfosdsrun = mysqli_query($con,$totoalfosds);
 echo mysqli_num_rows($totoalfosdsrun)
 ;?>   </div></center>

</div></div></div>

<div class="card"><div class="flex"><div class="bgcard first"><i class="fas fa-shipping-fast"></i></div><div class="textcard">
  <center>  in delivering <div class="subtext">
 <?php 
 $sqltoselectdeliviringproduct = "SELECT * FROM `orders` WHERE `status`='delivering'";
 $sqltoselectdeliviringproducttun = mysqli_query($con,$sqltoselectdeliviringproduct);
 echo mysqli_num_rows($sqltoselectdeliviringproducttun)
 ;?>    </div></center>

</div></div></div>

<?php 
$totoaluser = "SELECT * FROM `user` WHERE `type`='user' or `type`='deliver' AND `status`='active'";
$totaluserrun = mysqli_query($con,$totoaluser);
$numrowsofuseravtive = mysqli_num_rows($totaluserrun);

?>
<div class="card"><div class="flex"><div class="bgcard first">    <i class='bx bxs-user-circle' style="font-size: 45px; color:white;"></i></div>
<div class="textcard">
  <center>allow  user <div class="subtext">
 <?php echo $numrowsofuseravtive;?>    </div></center>

</div>
</div></div></div>


</div>
<br>

<?php
}else{
    echo "<script>location.href='../../index.php';</script>";

}
?>