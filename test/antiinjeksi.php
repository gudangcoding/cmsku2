<?php
	include "../library/config.php";
	include "../library/function_antiinjection.php";

	echo antiinjeksi("<script> alert('Website ini saya hack')</script>");