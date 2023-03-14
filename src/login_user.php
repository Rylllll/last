<?php

include_once('Connection.php');




if (isset($_SESSION['user'])) {
  echo $_SESSION['user']['username'];
} else {
  echo "";
}

?>