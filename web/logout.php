<?php

// Start the session
session_start();

session_unset();

header( "Location: login.html" );

?>