<?php
	$conn = new mysqli("localhost", "u925420712_pedidos_grao","kM7S6dT*", "u925420712_pedidos_grao");
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
