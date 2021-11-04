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
      <th scope="col">category</th>
      <th scope="col">price</th>
      <th scope="col">delete/edit</th>
    </tr>
  </thead>
  <?php 
  $tableofpending = "SELECT * FROM `foods`;
  
  ";
  $pendinguserun  = mysqli_query($con,$tableofpending);

  ?>
  <tbody>
      <?php 
      while($fetch = mysqli_fetch_assoc($pendinguserun)){
      
      ?>
    <tr>
    <td scope="row"  data-label="name"><?php echo htmlspecialchars($fetch['name']) ?></td>
  
      <td data-label="email" ><?php echo htmlspecialchars($fetch['category']) ?></td>
      <td data-label="type" ><?php echo htmlspecialchars($fetch['price']) ?></td>
      <td data-label="delete/view/allow" ><a href="?delfood=<?php echo htmlspecialchars($fetch['id']) ?>"><button class="loginbtn">delete</button> </a><a href="?update=<?php echo htmlspecialchars($fetch['name']) ?>"><button class="loginbtn">edit</button></a>
    </td>

    </tr>
<?php }}?>
  </tbody>
</table>