<?php
require "../../ink.php";
 $Id = $_GET['id'];
 $row =$authManager->getUserById($Id);
include("../../views/auth/userData.php");