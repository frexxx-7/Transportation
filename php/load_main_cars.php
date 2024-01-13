<?php
include "db.php";

if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

$sql = "SELECT * FROM `cars` order by id desc limit 6";
$result = $db->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo '<div class="car-item">';
    echo '<div class="car-item-image">';
    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="Image 3" style="width: 230px;">';
    echo '</div>';
    echo '<div class="car-item-title">' . $row["name"] . '</div>';
    echo '<div class="car-item-info">';
    echo '<div class="car-item-point">';
    echo '<img src="images/coins.png" alt="price" style="width:34px">';
    echo '<div>Цена</div>';
    echo '<div>' . $row["priceKM"] . '</div>';
    echo '</div>';
    echo '<div class="car-item-point">';
    echo '<img src="images/wheel.png" alt="Wheel">';
    echo '<div>Двигатель</div>';
    echo '<div>' . $row["engines"] . ' л.с</div>';
    echo '</div>';
    echo '<div class="car-item-point">';
    echo '<img src="images/year.png" alt="Belt" style="width:34px">';
    echo '<div>Год выпуска</div>';
    echo '<div>' . $row["year"] . '</div>';
    echo '</div>';
    echo '</div>';

    echo '<div class="moreDetalilContainer" style="display:none" id="moreDetalilContainer'.$row['id'].'">';
    echo '<p>Высота:' . $row["height"] . ' </p>';
    echo '<p>Грузоподъемность:' . $row["liftingCapacity"] . ' </p>';
    echo '<p>Длина:' . $row["length"] . ' </p>';
    echo '<p>Длина грузового отсека(платформы):' . $row["compartmentLength"] . ' </p>';
    echo '</div>';
    echo '<div class="car-item-action">';
    echo '<button onclick=\'window.location.href="#price"\' class="button car-button">Забронировать</button>';
    echo '</div>';
    echo '<div class="moreDetailsButton" id="moreDetails'.$row['id'].'">Подробнее</div>';
    echo '</div>';
    echo '<script>';
    echo 'document.getElementById("moreDetails'.$row['id'].'").onclick = function () {';
    echo 'console.log("sdfdf");';
    echo 'document.getElementById("moreDetalilContainer'.$row['id'].'").style.display = document.getElementById("moreDetalilContainer'.$row['id'].'").style.display == "block" ? "none" : "block"';
    echo '}';
    echo '</script>';

  }
} else {
  echo "<p>Ничего не обнаружено</p>";
}
?>