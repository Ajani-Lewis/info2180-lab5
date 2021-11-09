<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$country = $_GET['country'];
$mode = $_GET['mode'];

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$c_array = array();

?>

<table border="1" cellpadding="2">

<?php if($mode=="country"){ 
  
  if(count($results)<1){
    echo("Invalid Name Entered Try Again !");
  }else{ ?>
    <tr>
    <th>Country Name</th>
    <th>Continent</th>
    <th>Year of Independence</th>
    <th>Head of State</th>
  </tr>

  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['name']; ?></td>
      <td><?= $row['continent']; ?></td>
      <td><?= $row['independence_year']; ?></td>
      <td><?= $row['head_of_state']; ?></td>
    </tr>
  <?php endforeach;
  }  

}elseif($mode=="city"){

  if(count($results)<1){
    echo("Invalid Name Entered Try Again !");
  }else{

    foreach($results as $data){
      array_push($c_array,$data['code']);
    }
  
    ?>
  
      <tr>
        <th>City Name</th>
        <th>District</th>
        <th>Population</th>
      </tr>


      <?php
      foreach($c_array as $code){

      
      $stmt2 = $conn->query("SELECT * FROM cities WHERE country_code LIKE '%$code%'"); 
      $cityResults = $stmt2->fetchAll(PDO::FETCH_ASSOC);
      ?>
      
      
  
      <?php foreach ($cityResults as $row): ?>
        <tr>
          <td><?= $row['name']; ?></td>
          <td><?= $row['district']; ?></td>
          <td><?= $row['population']; ?></td>
        </tr>
      <?php endforeach; 
    }
  }
}?>
  
</table>