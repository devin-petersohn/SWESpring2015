<?php
//TODO: look at trigger_error()

	$package = array();

	function assert_fail($file, $line, $expr)
	{
		global $package;
		$package['file'] = $file;
		$package['line'] = $line;
		$package['failed_statement'] = $expr;
		//TODO: logging
		//TODO: figure out what the module will be
		header("Location:Error");
	}

	assert_options(ASSERT_CALLBACK, 'assert_fail');
	assert_options(ASSERT_WARNING, 0);

	$foo = 11;
//general form of how to use this.
//	$checks = assert("$foo == 12");
	




?>
