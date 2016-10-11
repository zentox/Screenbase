<?php

/**
 *
 * Enter description here ...
 */
function dbConnect() {
	static $link = null;
	if ($link === null) {
		if (!$link = mysqli_connect($GLOBALS['server'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database_name'])) {
			return false;
		}
		if (!mysqli_select_db($link, $GLOBALS['database_name'])) {
			return false;
		}
	}
	mysqli_query($link, "SET NAMES UTF8");
	return $link;
}

function dbSelect($query) {
	if (!$link = dbConnect()) {
		return false;
	}
	if (!$result = mysqli_query($link, $query)) {
		return false;
	}
	$table = array();
	while($row = mysqli_fetch_assoc($result)) {
		foreach ($row as $col => $val) {
			$row[$col] = stripslashes($val);
		}
		$table[] = $row;
	}
	return $table;
}

function dbInsert($table_name, $data) {
	if (!$link = dbConnect()) {
		return false;
	}

	$first_column = true;
	foreach ($data as $column => $value) {
		$value = mysqli_real_escape_string($link, trim($value));
		if ($first_column) {
			$columns = $column;
			$values = ($value!=null) ? "'$value'":"NULL";
			$first_column = false;
		} else {
			$columns .= ', '.$column;
			$values .= ($value!=null) ? ", '$value'":", NULL";
		}
	}

	$query = "INSERT INTO $table_name($columns) VALUES ($values)";

	if (!mysqli_query($link, $query)) {
		return false;
	}
	if ($id = mysqli_insert_id($link)) {
		return $id;
		echo $id;
	} else {
		return true;
	}
}

function dbUpdate($table_name, $data, $where = null) {
	if (!$link = dbConnect()) {
		return false;
	}

	$first_column = true;
	foreach ($data as $column => $value) {
		$value = mysqli_real_escape_string($link, trim($value));
		if ($first_column) {
			$values = ($value!=null) ? "$column = '$value'":"$column = NULL";
			$first_column = false;
		} else {
			$values .= ($value!=null) ? ", $column = '$value'":", $column = NULL";
		}
	}
	$query = "UPDATE $table_name SET $values";
	if (!is_null($where)) {
		$query .= ' WHERE '.$where;
	}

	//echo $query;

	if (!mysqli_query($link, $query)) {
		return false;
	}
	return true;
}

function dbDelete($table_name, $where)
{
	if (!$link = dbConnect())
	{
		return false;
	}

	$query = "DELETE FROM $table_name WHERE $where";

	echo $query;

	if (!mysqli_query($link, $query))
	{
		return false;
	}
	return true;
}

function dbDeleteField($field, $table_name, $where)
{
	if (!$link = dbConnect())
	{
		return false;
	}

	$query = "DELETE $field FROM $table_name WHERE $where";

	echo $query;

	if (!mysqli_query($link, $query))
	{
		return false;
	}

	return true;
}

function dbGetLastInsertId()
{
	if (!$link = dbConnect())
	{
		return false;
	}

	return mysqli_insert_id($link);
}

?>