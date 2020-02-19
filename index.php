<?php

namespace webshop_v2;

require('AutoLoader.php');

use webshop_v2\Models as Models;
use webshop_v2\Views as Views;
use webshop_v2\Controllers as Controllers;

session_start();

$application_controller = new Controllers\ApplicationController();
$application_controller->resolveRequest();
