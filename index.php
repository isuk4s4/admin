<?php 
/*session start*/
session_start();
/*include db connection*/
require_once("db/index.php");

if(isset($_REQUEST['name']) and isset($_REQUEST['pass']))
{
/*username validatoin 1*/    if(empty($_REQUEST['name'])){
        $adminloginerror['1'] = "username is empty";
    }else{
        /*uname escaping and encoding*/
        $uname = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['name']));
    }
    /*pass validation*/
    if(empty($_REQUEST['pass'])){
        $adminloginerror['2'] = "password is empty";
    }else{
           /*pass escaping and encoding*/
        $password = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['pass']));
    }
    if(isset($uname) and isset($password)){
        /*query to login*/
        $selectadmin = "SELECT * FROM `user` WHERE `uname`='$uname' and `password`='$password' AND `type`='admin' AND `status`='active'";
        /*run*/
        $adminlginrun = mysqli_query($con,$selectadmin);
        /*check num rows*/
        if(mysqli_num_rows($adminlginrun) > 0){
            /*create session*/
            $_SESSION['login'] = $uname;
            /*redirect tot home */
            echo "<script>location.href='index.php?home';</script>";
        }else{
            /*faild login erro msg*/
            $adminloginerror['3'] = "invaild details";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- box icnons-->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
       <!--boostrape-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
    <!--popper js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <!-- boostrape min.js-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- font awsome icons -->
       <script src="https://kit.fontawesome.com/6f8184fbbc.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
   <script src="assets/js/alert.js"></script>
    <title>ANDRO FOODS</title>
<?php 

/*check login session is exist*/
    if(isset($_SESSION['login']))
    {
    ?>
    <!--main css -->
    <link rel="stylesheet" href="assets/css/styles.css">
    </head>
<body id="body-pd">
<!--header -->
    <header class="header" id="header">
        <div class="header__toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>

        <div class="header__img">
            <i class='bx bxs-user-circle' style="font-size: 45px; color:white;"></i>
        </div>
    </header>
<!--navbar-->
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav__logo">
                    <i class='bx bxs-cookie nav__logo-icon'></i>

                    <span class="nav__logo-name">Andro Foods</span>
                </a>

                <div class="nav__list">
                    <a href="?home" class="nav__link active">
                        <i class='bx bx-grid-alt nav__icon'></i>
                        <span class="nav__name">Dashboard</span>
                    </a>

                    <a href="?alluser" class="nav__link">
                        <i class='bx bx-user nav__icon'></i>
                        <span class="nav__name">Users</span>
                    </a>

                    <a href="?pendinguser" class="nav__link">
                        <i class='bx bx-user-plus nav__icon'></i>
                        <span class="nav__name">pending user</span>
                    </a>

                    <a href="?categories" class="nav__link">
                    <i class='bx bxs-food-menu  nav__icon' ></i>
                        <span class="nav__name">category</span>
                    </a>

                    <a href="?addfood" class="nav__link">
                        <i class='bx bx-folder nav__icon'></i>
                        <span class="nav__name">add food</span>
                    </a>

                    <a href="?allfoods" class="nav__link">
                    <i class='bx bx-food-tag nav__icon'></i>
                        <span class="nav__name">all foods</span>
                    </a>
                    <a href="?adduser" class="nav__link">
                    <i class='bx bxs-user-pin nav__icon'></i>
                        <span class="nav__name">add admin</span>
                    </a>
                </div>
            </div>

            <a href="?logout" class="nav__link">
                <i class='bx bx-log-out nav__icon'></i>
                <span class="nav__name">Log Out</span>
            </a>
        </nav>
    </div>

 

    <script src="assets/js/main.js"></script>
    <?php 
    /*include statics*/
    require_once("assets/php/static.php");
    
    ?>
<?php 
/*check requests are empty*/
if(empty($_REQUEST)){
    echo "<script>location.href='?home';</script>";
}
?>
<?php 

if(isset($_REQUEST['logout'])){
    /*logout*/
    session_destroy();
    echo "<script>location.href='index.php';</script>";
}
?>

<?php 

if(isset($_REQUEST['home']))
{
    ?>

    <!-- pendin users -->
<div style="width:100%;height:90px;background:#23212f;box-shadow:0px 0px 4px 4px #00000014;">
<div class="posiotnabs">
<center> pending users</center>
</div>
</div>
<button class="loadbtn">reload</button>
<div class="outputtable">

</div>
<script>
$(".outputtable").load("assets/php/table.php");
$(document).ready(function(){
    $(".loadbtn").click(function(){
        $(".outputtable").load("assets/php/table.php");
    });
});
</script>
<div style="width:100%;height:90px;background:#23212f;box-shadow:0px 0px 4px 4px #00000014;">
<div class="posiotnabs">
<center> add food category</center>
</div>
</div>
<br>
<form action="#" method="post" enctype="multipart/form-data">
<div class="cetgoryupload">
<input type="text" name="categoryname" id="cetgoryinputs">
<br>
  <label class="label" id="cetgoryinputs">
        <input type="file" name="icon" id="cetgoryinputs"/>
        <span id="cetgoryinputs">Select a file</span>
      </label>
      <button class="loadbtn submitbtn" style="    height: min-content;padding:5px 15px
; margin-top:auto;margin-bottom:auto;float: none;
    width: min-content;">submit</button>
</div>
</form>
    <?php
    if(isset($_REQUEST['categoryname']) and isset($_FILES['icon'])){

if(empty($_REQUEST['categoryname']))
{
?>
      <div class="alert">
 
 <strong>inputs are empty</strong>
 <div class="alertprogress"></div>
 </div>
 
<?php
}else{
    /*validations*/
    $categorynae = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['categoryname']));
    $filename = $_FILES['icon']['name'];
    $filetemp = $_FILES['icon']['tmp_name'];
    $filerror = $_FILES['icon']['error'];
    $filesize = $_FILES['icon']['size'];
    $fileext =  explode('.',$filename);
    $filextentionget = strtolower($fileext[1]);
    $filextention = array("png","svg","jpg","jpg");
if(in_array($filextentionget,$filextention)){
if($filesize > 20000){
?>
          <div class="alert">
 
 <strong>file size is too larg</strong>
 <div class="alertprogress"></div>
 </div>
 

<?php
}else{
if(empty($filerror)){
$path = "assets/icons";
 $filepath = $path  . basename($filename);
move_uploaded_file($filetemp,$filepath);
//*query to add cetegory*/
$succsessupload = "INSERT INTO `category`(`cname`, `cimg`)
VALUES(
    '$categorynae',
    '$path/$filename'

)";
$myquery = mysqli_query($con,$succsessupload);
if($myquery)
{
    echo "<script>location.href='index.php?categories';</script>"; 

}
}else{
    ?>
          <div class="alert">
 
 <strong>somthinge is went wrong</strong>
 <div class="alertprogress"></div>
 </div>
 
    
    <?php
}
}
}else{
    ?>
          <div class="alert">
 
 <strong>file extension is doesn't support</strong>
 <div class="alertprogress"></div>
 </div>
 
    
    <?php
}
    
}
    }
}
?>


<?php 
if(isset($_REQUEST['deluser'])){
if(empty($_REQUEST['deluser'])){
    ?>
      <div class="alert">
 
<strong>user id is empty</strong>
<div class="alertprogress"></div>
</div>

    <?php
}else{
    /*user id validation*/
    if(is_numeric($_REQUEST['deluser'])){
        
$userid =htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['deluser']));
/*chech user is exist*/
$useridavilablity = "SELECT * FROM `user` WHERE `id`='$userid'";
$deleteavailivityrun = mysqli_query($con,$useridavilablity);
/*check numrws*/
if(mysqli_num_rows($deleteavailivityrun) == 1){
    /*delete user*/
$delquery = "DELETE FROM `user` WHERE `id`='$userid'";

$rundelquery = mysqli_query($con,$delquery);
if($rundelquery){
    echo "<script>location.href='index.php?home';</script>";
}}else{
    ?>
    <div class="alert">
 
 <strong>user id is not found </strong>
 <div class="alertprogress"></div>
 </div>
    <?php
}
    }else{
        ?>  <div class="alert">
 
        <strong>user id is inavild</strong>
        <div class="alertprogress"></div>
        </div>
        
        <?php
    }
}
}
?>
<?php 

if(isset($_REQUEST['allowuser']))
{
    if(empty($_REQUEST['allowuser'])){
?>
 <div class="alert">
 
 <strong>user id is empty</strong>
 <div class="alertprogress"></div>
 </div>
 
<?php
    }else{
if(is_numeric($_REQUEST['allowuser'])){
    /*allow user*/
$allowuserid = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['allowuser']));
$selectid = "SELECT * FROM `user` WHERE `id`='$allowuserid'";
if(mysqli_num_rows(mysqli_query($con,$selectid)) == 1){
    $allowing =  "UPDATE
    `user`
SET
 
    `status` = 'active'
  
WHERE
    `id`='$allowuserid'
    ";
  $uodatingallow = mysqli_query($con,$allowing);
if($uodatingallow){
    echo "<script>location.href='index.php';</script>";
}
}else{
    ?>
     <div class="alert">
 
 <strong>user id is invaild</strong>
 <div class="alertprogress"></div>
 </div><?php
}
}else{
    ?> <div class="alert">
 
    <strong>user id is invaild</strong>
    <div class="alertprogress"></div>
    </div><?php
}
    }
}
?>
<?php 

if(isset($_REQUEST['viewuser']))
{
    ?>
    <br><br>
    <?php 
    
    if(empty($_REQUEST['viewuser']))
    {
?>
 <div class="alert">
 
 <strong>user id is empty</strong>
 <div class="alertprogress"></div>
 </div>
 <?php
    }else{
        if(is_numeric($_REQUEST['viewuser'])){
            $viewuserid = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['viewuser']));
?>


<?php 
/*get user data*/
$selectfromidtobanner  = "SELECT * FROM `user` WHERE `id`='$viewuserid'";
$selectfromidtobannerrun = mysqli_query($con,$selectfromidtobanner);
if(mysqli_num_rows($selectfromidtobannerrun) == 1){
$fetcchassoc = mysqli_fetch_assoc($selectfromidtobannerrun);
?>
<div style="width:100%;height:90px;background:#23212f;box-shadow:0px 0px 4px 4px #00000014;">
<div class="posiotnabs">
<center>view <?php echo htmlspecialchars($fetcchassoc['uname'])?></center>
</div>
</div>
<div class="space">
    <div class="center">
    <div class="flexboxlandspac">
<?php 
$selectfromid  = "SELECT * FROM `user` WHERE `id`='$viewuserid'";
$queryselectfromiduserview = mysqli_query($con,$selectfromid);
while($fetchinguser = mysqli_fetch_assoc($queryselectfromiduserview)){
?>
        <label>name</label>
        <div class="values"><?php echo $fetchinguser['uname'];?></div>
        </div>
        <div class="flexboxlandspac">
        <label>email</label>
        <div class="values"><?php echo $fetchinguser['email'];?></div>
        </div>
        <div class="flexboxlandspac">
        <label>password</label>
        <div class="values"><?php echo $fetchinguser['password'];?></div>

        </div>
        <div class="flexboxlandspac">
        <label>type</label>
        <div class="values"><?php echo $fetchinguser['type'];?></div>
        
        </div></div>
 
</div>

        <?php }}else{?>
            <div class="alert">
 
 <strong>user id is invaild</strong>
 <div class="alertprogress"></div>
 </div>
            <?php }?>

    <?php
    }else{
        ?>
         <div class="alert">
 
 <strong>user id is invaild</strong>
 <div class="alertprogress"></div>
 </div>
        <?php
    }}
    ?>  
    <?php
}
?><?php 



if(isset($_REQUEST['categories']))
{
    ?>
  
<div style="width:100%;height:90px;background:#23212f;box-shadow:0px 0px 4px 4px #00000014;">
<div class="posiotnabs">
<center> all categories</center>
</div>
</div>
<br>
    <table class="table table-bordered tab">
  <thead>
    <tr>
      <th scope="col">category name </th>
      <th scope="col">delete</th>
     
    </tr>
  </thead>
  <?php 
$tablecategory = "SELECT * FROM `category`;";
$queryrun = mysqli_query($con,$tablecategory);
  ?>
  <tbody>
     <?php  while($fetchcategory = mysqli_fetch_assoc($queryrun)){
         ?>
    <tr>
    <td scope="row"  data-label="name"><?php echo $fetchcategory['cname']; ?></td>
  
      <td data-label="delete" ><a href="?deletecategory=<?php echo $fetchcategory['cid']?>"><div class="loginbtn">delete</div></a></td>


    </tr>
<?php }?>
  </tbody>
</table>

    
    <?php
}

?>
<?php  
if(isset($_REQUEST['deletecategory']))
{
    if(empty($_REQUEST['deletecategory']))
    {
        ?>
        
        <div class="alert">
 
 <strong>id is empty</strong>
 <div class="alertprogress"></div>
 </div>
        
        <?php
    }else{
        if(is_numeric($_REQUEST['deletecategory']))
    {
$deletecategory = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['deletecategory']));
$deletecategoryquery = "SELECT * FROM `category` WHERE `cid`='$deletecategory'";
$querycheck = mysqli_query($con,$deletecategoryquery);
if(mysqli_num_rows($querycheck) == 1){
$deleteing = "DELETE
FROM
    `category`
WHERE
    `cid`='$deletecategory'";
$deletecategoryrun = mysqli_query($con,$deleteing);
if($deletecategoryrun){
echo "<script>location.href='?categories'</script>";
}else{
    ?>
         <div class="alert">
 
 <strong> somethung went wrong</strong>
 <div class="alertprogress"></div>
 </div>
    <?php
}

}else{
    ?>
       <div class="alert">
 
 <strong> id is invaild</strong>
 <div class="alertprogress"></div>
 </div>
    <?php
}
    }else{
        ?>
<div class="alert">
 
 <strong> id is invaild</strong>
 <div class="alertprogress"></div>
 </div>
        
        
        <?php
    }
    }
}
?>
<?php 
 if(isset($_REQUEST['alluser']))
{
    ?>

<div style="width:100%;height:90px;background:#23212f;box-shadow:0px 0px 4px 4px #00000014;">
<div class="posiotnabs">
<center> all  users</center>
</div>
</div>
    <div class="loadbtn">reload</div>
    <div class="output"></div>
    <script>
        $(".output").load("assets/php/alluser.php");
$(document).ready(function(){
    $(".loadbtn").click(function(){
        $(".output").load("assets/php/alluser.php");
    });
});
    </script>
    <?php
}
?>
<?php 

if(isset($_REQUEST['pendinguser']))
{
    ?>

<div style="width:100%;height:90px;background:#23212f;box-shadow:0px 0px 4px 4px #00000014;">
<div class="posiotnabs">
<center>all pending users</center>
</div>
</div>
<br>
    <div class="loadbtn">reload</div>
    <div class="output"></div>
    <script>
        $(".output").load("assets/php/pending.php");
$(document).ready(function(){
    $(".loadbtn").click(function(){
        $(".output").load("assets/php/pending.php");
    });
});
    </script>
    
    <?php
}
?>
<?php 


if(isset($_REQUEST['addfood']))
{
?>
<div style="width:100%;height:90px;background:#23212f;box-shadow:0px 0px 4px 4px #00000014;">
<div class="posiotnabs">
<center>add food</center>
</div>
</div>
<form action="#" method="post" class="add">
<div class="inputflex">
    <div class="lable"><label>food name</label></div>
    <input type="text" name="fname" id="fname">
    
</div>

<div class="inputflex">
    <div class="lable"><label>food price</label></div>
    <input type="text" name="fprice" id="fprice">
    
</div>
<div class="inputflex">
    <div class="lable"><label>food availibity</label></div>
    <input type="text" name="fa" id="fa" placeholder="you can enter empty data of avalibility">
    
</div>
<div class="inputflex">
    <div class="lable"><label>food description</label></div>
    <input type="text" name="fd" id="fd" placeholder="you can enter empty data of description">
    
</div>
<div class="inputflex">
    <div class="lable"><label>food offer</label></div>
    <input type="text" name="fdo" id="fo" placeholder="you can enter empty data of description">
    
</div>
<div class="inputflex">
    <div class="lable"><label>image link</label></div>
    <input type="text" name="fdimg" id="fo">
    
</div>
<div class="inputflex">
<select name="fcategory" class="form-select" aria-label="Default select example">
<?php 

$selectcategory = "SELECT * FROM `category`";
$querytogetcategory = mysqli_query($con,$selectcategory);
while($cetegoryname = mysqli_fetch_assoc($querytogetcategory)){
?>
<option  value="<?php echo $cetegoryname['cname']?>"><?php echo $cetegoryname['cname']?></option>
<?php }?>
</select>
<button class="btn btn-primary ml-3">add</button>
</div>

</form>

<?php 
if(isset($_REQUEST['fname']) and isset($_REQUEST['fprice']) and isset($_REQUEST['fa']))
{
if(empty($_REQUEST['fname'])  or empty($_REQUEST['fprice']) or empty($_REQUEST['fcategory'])){
    ?>
           <div class="alert">
 
 <strong>some inputs are empty</strong>
 <div class="alertprogress"></div>
 </div>
    <?php
}else{
    
$fname =  htmlentities(mysqli_real_escape_string($con,$_REQUEST['fname']));

$fprice  = htmlentities(mysqli_real_escape_string($con,$_REQUEST['fprice']));
$fdes = htmlentities(mysqli_real_escape_string($con,$_REQUEST['fd']));
$fa  = htmlentities(mysqli_real_escape_string($con,$_REQUEST['fa']));
$fcategory  = htmlentities(mysqli_real_escape_string($con,$_REQUEST['fcategory']));
$fo  = htmlentities(mysqli_real_escape_string($con,$_REQUEST['fdo']));
$fmage = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['fdimg']));
$insertfood = "
INSERT INTO `foods`(
    `name`,
    `category`,
    `price`,
    `img`,
    `availability`,
    `offer`,
    `fdes`
)
VALUES(
    '$fname',
    '$fcategory',
    '$fprice',
    '$fmage',
    '$fa',
    '$fo',
    '$fdes'
)
";
$addfoods = mysqli_query($con,$insertfood);
if($addfoods){
    $selectfoodtoupdatelink  = "SELECT * FROM `foods` WHERE `name`='$fname'";
    $mysqliquery = mysqli_query($con,$selectfoodtoupdatelink);
if(mysqli_num_rows($mysqliquery) >0){
    $getfoodsid = mysqli_fetch_assoc($mysqliquery);
$nameofood = $getfoodsid['name'] ;

    echo "<script>location.href='?update=$nameofood';</script>";
}
}
}
}
?>
<?php
}
?>
<?php 

if(isset($_REQUEST['update']))
{
    
    if(empty($_REQUEST['update']))
{


    ?>
        <div class="alert">
 
 <strong>food name is empty</strong>
 <div class="alertprogress"></div>
 </div>
    <?php
}else{
    $updatename = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['update']));

    $updateselectqueryone = "SELECT * FROM `foods` WHERE `name`='$updatename'";
    
$querytoupdate = mysqli_query($con,$updateselectqueryone);
if(mysqli_num_rows($querytoupdate) > 0)
{?><form action="#" method="post">
<?php
while($fetchupdateselection = mysqli_fetch_assoc($querytoupdate)){
?>
    
    <div style="width:100%;height:90px;background:#23212f;box-shadow:0px 0px 4px 4px #00000014;">
<div class="posiotnabs">
<center> update <?php  echo htmlspecialchars($fetchupdateselection['name']); ?></center>
</div>
</div>

<div class="inputflex">
    <div class="lable"><label> mame</label></div>
    <input type="text" name="ufname" id="fo" value="<?php echo htmlspecialchars($fetchupdateselection['name']); ?>">
    <br>
   
</div>
<div class="inputflex">
    <div class="lable"><label> price</label></div>
    <input type="text" name="uprice" id="fo" value="<?php echo htmlspecialchars($fetchupdateselection['price']); ?>">
    <br>
   
</div>
<div class="inputflex">
    <div class="lable"><label> availibity</label></div>
    <input type="text" name="ua" id="fo" value="<?php echo htmlspecialchars($fetchupdateselection['availability']); ?>">
    <br>
   
</div>
<div class="inputflex">
    <div class="lable"><label> offer</label></div>
    <input type="text" name="uo" id="fo" value="<?php echo htmlspecialchars($fetchupdateselection['offer']); ?>">
    <br>
   
</div>
<div class="inputflex">
    <div class="lable"><label> description</label></div>
    <input type="text" name="ud" id="fo" value="<?php echo htmlspecialchars($fetchupdateselection['fdes']); ?>">
    <br>
   
</div>

<div class="inputflex">
    <div class="lable"><label> img</label></div>
    <input type="text" name="uimg" id="fo" value="<?php echo htmlspecialchars($fetchupdateselection['img']); ?>">
    <br>
   
</div>
<?php }?>
<br>
<select name="ucategory" class="form-select" aria-label="Default select example">
<?php 

$selectcategory = "SELECT * FROM `category`";
$querytogetcategory = mysqli_query($con,$selectcategory);
while($cetegoryname = mysqli_fetch_assoc($querytogetcategory)){
    $nameofffodtoupdate = $cetegoryname['id'];
?>
<option  value="<?php echo $cetegoryname['cname']?>"><?php echo $cetegoryname['cname']?></option>

<?php }?>
</select>
<button class="btn btn-dark ml-3">update</button>
</form>
<?php

}else{
    ?>  <div class="alert">
 
    <strong>product is not found</strong>
    <div class="alertprogress"></div>
    </div>
    
    <?php
}
}
}
?>
<?php 

if(isset($_REQUEST['ufname']) and isset($_REQUEST['uprice']) and isset($_REQUEST['ua']) and isset($_REQUEST['ud']) and isset($_REQUEST['uimg']) and isset($_REQUEST['ucategory']) and isset($_REQUEST['uo'])){
    if(empty($_REQUEST['ufname']) or empty($_REQUEST['uprice']) or empty($_REQUEST['uimg'])){
?>

<div class="alert">
 
 <strong>some inputs are empty</strong>
 <div class="alertprogress"></div>
 </div>

<?php
    }else{
$ufname = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['ufname']));
$uprice = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['uprice']));
$ud = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['ud']));
$uo = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['uo']));
$uimg = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['uimg']));
$ua = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['ua']));
$ucategory = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['ucategory']));
$sqltoupdatefood = "UPDATE
`foods`
SET
`name` = '$ufname',
`category` = '$ucategory',
`price` = '$uprice',
`img` = '$uimg',
`availability` = '$ua',
`offer` = '$uo',
`fdes` = '$ud'
WHERE
`name`='$updatename'
";
$updatingfood = mysqli_query($con,$sqltoupdatefood);
if($updatingfood){
    echo "<script>location.href='?update=$ufname';</script>";

}else{
    ?>
    
    <div class="alert">
 
 <strong>error</strong>
 <div class="alertprogress"></div>
 </div>

    
    <?php
}
    }           
}           

?>    
<?php 

if(isset($_REQUEST['allfoods']))
{
    ?>
    
    <div style="width:100%;height:90px;background:#23212f;box-shadow:0px 0px 4px 4px #00000014;">
<div class="posiotnabs">
<center> all  food</center>
</div>
    </div>
    <br>
    <div class="output"></div>
    <script>
        $(".output").load("assets/php/allfoods.php");
$(document).ready(function(){
    $(".loadbtn").click(function(){
        $(".output").load("assets/php/alluser.php");
    });
});
    </script>
    <?php
}
?>
       <?php 
       
       if(isset($_REQUEST['delfood']))
{
    if(empty($_REQUEST['delfood'])){
?>

<div class="alert">
 
 <strong>error</strong>
 <div class="alertprogress"></div>
 </div>

    
    

<?php
    }else{
if(is_numeric($_REQUEST['delfood'])){
$delfoodid = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['delfood']));
$delefoodquery = "
DELETE
FROM
    `foods`
WHERE
`id`='$delfoodid'
";
$delefoodsrun = mysqli_query($con,$delefoodquery);
if($delefoodsrun){
echo "<script>location.href='?allfoods';</script>";
}else{
?>

<div class="alert">
 
 <strong>error</strong>
 <div class="alertprogress"></div>
 </div>

    

<?php
}
}else{
    ?>
    
<div class="alert">
 
 <strong>error</strong>
 <div class="alertprogress"></div>
 </div>

    
    

    <?php
}
    }
}
       ?>
       <?php 
       
       
       if(isset($_REQUEST['adduser']))
       {
           ?>
           
           
           <div style="width:100%;height:90px;background:#23212f;box-shadow:0px 0px 4px 4px #00000014;">
<div class="posiotnabs">
<center>add admin</center>
</div>
</div>
   <br>
<form action="#" method="post" class="add">
<div class="inputflex">
    <div class="lable"><label>admin username</label></div>
    <input type="text" name="auname" id="fname">
    
</div>
<div class="inputflex">
    <div class="lable"><label>admin passwrod</label></div>
    <input type="text" name="apass" id="fname">
    
</div>
<div class="inputflex">
    <div class="lable"><label>conform password</label></div>
    <input type="text" name="acpass" id="fname">
    
</div>
<div class="inputflex">
    <div class="lable"><label>admin email</label></div>
    <input type="text" name="aemail" id="fname">
    
</div>

<button class="btn btn-dark">add</button>
</form>

           <?php
       }
       ?>
       
    <?php 
    
    if(isset($_REQUEST['auname']) and isset($_REQUEST['apass']) and isset($_REQUEST['acpass']) and isset($_REQUEST['aemail']))
    {
    
        if(empty($_REQUEST['auname']) and empty($_REQUEST['apass']) and empty($_REQUEST['acpass']) and empty($_REQUEST['aemail']))
        {
?>

    
<div class="alert">
 
 <strong>error</strong>
 <div class="alertprogress"></div>
 </div>

    
<?php
        }else{
if($_REQUEST['apass'] == $_REQUEST['acpass']){
$nameadmin = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['auname']));
$passadmin = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['apass']));
if(filter_var($_REQUEST['aemail'],FILTER_VALIDATE_EMAIL)){
$aemail = htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST['aemail']));
$admininserquery = "INSERT INTO `user`(
    `uname`,
    `password`,
    `email`,
    `type`,
    `status`
)
VALUES(
    '$nameadmin',
    '$passadmin',
    '$aemail',
    'admin',
    'active'

)";
$admininserqueryrun = mysqli_query($con,$admininserquery);
if($admininserqueryrun){
echo "<script>location.href='?alluser';</script>";
}else{
    ?>
        
<div class="alert">
 
 <strong>error</strong>
 <div class="alertprogress"></div>
 </div>

    
    <?php
}
}else{
    ?>
    <div class="alert">
 
 <strong>error</strong>
 <div class="alertprogress"></div>
 </div>

    
    <?php
}
}else{
    ?>
        
<div class="alert">
 
 <strong>error</strong>
 <div class="alertprogress"></div>
 </div>
    
    <?php
}
        }
    }
    ?>
</body>

<?php }else{
    /*login secction*/
    ?>

    <link rel="stylesheet" href="assets/css/login.css">
    <?php 
    
if(isset($adminloginerror)){
    foreach($adminloginerror as $adminloginerrors){
        ?>
             <div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
<strong><?php echo $adminloginerrors;?> </strong>

</div>


        <?php
    }
}

    ?>
<div class="formlogin">
    <div class="background">
   <center>   <img src="assets/img/undraw_control_panel_re_y3ar.svg" alt=""></center>  
    </div>
    <div class="loginforms">

        <form action="#" method="post"class="userlogin actlogin">
      <center><h1 class="textlogin">Andro <span style="color: #32DE84;"class="textlogin">Foods</span></h1></center>
        <div >
<input type="text" name="name" id="logininputs" placeholder="username ">
<br><br>
<input type="password" name="pass"  id="logininputs" placeholder="password ">
<br><br>
</div>

<center>
<button class="loginbtn">Login</button>
<br><br>

</center>      

</form>

</div>

        <?php }?>
</html>