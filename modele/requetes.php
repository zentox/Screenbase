<?php

function addScreen($url, $insertDate, $ip, $nav, $tag01, $tag02, $tag03, $tag04, $tag05, $tag06, $tag07, $tag08, $tag09, $tag10)
{
	$data = array(
		'url'			=> $url,
		'insertDate'	=> $insertDate,
		'ip'			=> $ip,
		'nav'			=> $nav,
		'tag01'			=> $tag01,
		'tag02'			=> $tag02,
		'tag03'			=> $tag03,
		'tag04'			=> $tag04,
		'tag05'			=> $tag05,
		'tag06'			=> $tag06,
		'tag07'			=> $tag07,
		'tag08'			=> $tag08,
		'tag09'			=> $tag09,
		'tag10'			=> $tag10);

	return dbInsert('screens', $data);
}

function getAllScreens()
{
	return dbSelect(
		"SELECT *
		from screens
		order by id desc");
}

function getScreensFromTag($tag)
{
	return dbSelect(
		"SELECT *
		from screens
		where tag01 like '%$tag%'
		or tag02 like '%$tag%'
		or tag03 like '%$tag%'
		or tag04 like '%$tag%'
		or tag05 like '%$tag%'
		or tag06 like '%$tag%'
		or tag07 like '%$tag%'
		or tag08 like '%$tag%'
		or tag09 like '%$tag%'
		or tag10 like '%$tag%'
		order by id desc");
}

function getScreensFromUrl($url)
{
	return dbSelect(
		"SELECT id
		from screens
		where url like '$url'");
}

function getOthersScreensFromUrl($url, $id)
{
	return dbSelect(
		"SELECT id
		from screens
		where url like '$url'
		and id not like '$id'");
}

function getScreensFromId($id)
{
	return dbSelect(
		"SELECT *
		from screens
		where id like '$id'");
}

function getLastScreen()
{
	return dbSelect(
		"SELECT *
		from screens
		where insertDate like (SELECT max(insertDate)
			from screens)");
}

function deleteScreen($id)
{
	return dbDelete('screens', "id = $id");
}

function updateScreen($id, $url, $tag01, $tag02, $tag03, $tag04, $tag05, $tag06, $tag07, $tag08, $tag09, $tag10)
{
	$data = array(
		'url'			=> $url,
		'tag01'			=> $tag01,
		'tag02'			=> $tag02,
		'tag03'			=> $tag03,
		'tag04'			=> $tag04,
		'tag05'			=> $tag05,
		'tag06'			=> $tag06,
		'tag07'			=> $tag07,
		'tag08'			=> $tag08,
		'tag09'			=> $tag09,
		'tag10'			=> $tag10);

	return dbUpdate('screens', $data, "id = $id");
}

?>