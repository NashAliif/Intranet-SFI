<?php

if (!session_id()) {
    session_start();
}

require_once '../Intranet/app/init.php';

$app = new App();
