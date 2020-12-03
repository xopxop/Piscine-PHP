#!/usr/bin/php
<?php
function get_web_page($url) {
	$option = array(
		CURLOPT_URL => $url,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_RETURNTRANSFER => true,
	);
	$curl = curl_init();
	curl_setopt_array($curl, $option);
	$page = curl_exec($curl);
	curl_close($curl);
	return $page;
}

if ($argc == 2) {
	$url = $argv[1];
	if ($url[strlen($url) - 1] == '/')
		$url = substr($url, 0, strlen($url) - 1);
	$folder = "./" . preg_replace("/^https?:/", '', $url);
	$page = get_web_page($url);   //<<<<< data of the website will go here
	// ===> Taking the addess of the images  <===
	$img = array();
	preg_match_all("/<img[^>]+.jpg\"/i", $page, $matches);
	$img = array_merge($img, $matches[0]);
	preg_match_all("/<img[^>]+.svg\"/i", $page, $matches);
	$img = array_merge($img, $matches[0]);
	preg_match_all("/<img[^>]+.png\"/i", $page, $matches);
	$img = array_merge($img, $matches[0]);
	preg_match_all("/<img[^>]+.jpeg\"/i", $page, $matches);
	$img = array_merge($img, $matches[0]);
	preg_match_all("/<img[^>]+.gif\"/i", $page, $matches);
	$img = array_merge($img, $matches[0]);
	for($i = 0; $i < count($img); $i++)
		$img[$i] = preg_replace("/^.*src=/", "" , $img[$i]);
	for($i = 0; $i < count($img); $i++)
		$img[$i] = preg_replace("/\"/", "" , $img[$i]);
	for($i = 0; $i < count($img); $i++) {
		if (!preg_match("/^https?:/", $img[$i])) {
			if ($img[$i][0] != '/')
				$img[$i] = $url . "/" . $img[$i];
			else
			$img[$i] = $url . $img[$i];
		}
	}
	$img = array_unique($img);
	$img = array_values($img);
	// ===> curl and store images <===
	if (!file_exists($folder))
		mkdir($folder);
	foreach ($img as $elem) {
		$option = array(
			CURLOPT_URL => $elem,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_BINARYTRANSFER => true,
		);
		$curl = curl_init();
		curl_setopt_array($curl, $option);
		$data = curl_exec($curl);
		curl_close($curl);
		$name = substr($elem, strrpos($elem, '/'));
		if (!file_exists($folder . "/" . $name)) {
			$file = fopen($folder . "/" . $name, 'x');
			fwrite($file, $data);
			fclose($file);
		}
	}
}
?>