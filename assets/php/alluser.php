<?php 
session_start();
require_once("../../db/index.php")
?>
<?php 

if(empty($_SESSION['login'])){
    echo "<script>location.href='../index.php';</script>";
}else{
?>
<table class="table table-bordered tab">
  <thead>
    <tr>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">type</th>
      <th scope="col">allow/delete/view</th>
    </tr>
  </thead>
  <?php 
  $tableofpending = "SELECT * FROM `user` ORDER BY `user`.`id` DESC;
  
  ";
  $pendinguserun  = mysqli_query($con,$tableofpending);

  ?>
  <tbody>
      <?php 
      while($fetch = mysqli_fetch_assoc($pendinguserun)){
      
      ?>
    <tr>
    <td scope="row"  data-label="name"><?php echo htmlspecialchars($fetch['uname']) ?></td>
  
      <td data-label="email" ><?php echo htmlspecialchars($fetch['email']) ?></td>
      <td data-label="type" ><?php echo htmlspecialchars($fetch['type']) ?></td>
      <td data-label="delete/view/allow" ><a href="?deluser=<?php echo htmlspecialchars($fetch['id']) ?>"><button class="loginbtn">delete</button></a>
      <a href="?viewuser=<?php echo htmlspecialchars($fetch['id']) ?>"><button class="loginbtn">view</button></a></td>

    </tr>
<?php }}?>
  </tbody>
</table>