<?php

session_start();

session_destroy();

include('database.php');

redirect("index.php");