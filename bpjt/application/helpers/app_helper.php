<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

	function create_slug($string) {
		$string = strtolower($string);
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		$string = preg_replace("/[\s-]+/", " ", $string);
		$string = preg_replace("/[\s_]/", "-", $string);

		return $string;
	}

	function print_formatted_date($datetime) {
		$days = array("", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Minggu");
		$time = strtotime($datetime);

		$formatted = $days[date('N', $time)] . ", " . date("d/m/Y", $time) . " " . date("H:i:s", $time) . " WIB";
		return $formatted;
	}

	function print_date($datetime) {
		$days = array("", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Minggu");
		$time = strtotime($datetime);

		$formatted = $days[date('N', $time)] . ", " . date("d/m/Y", $time);
		return $formatted;
	}

	function print_casual_date($datetime) {
		$months = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$time = strtotime($datetime);

		return date('d', $time) . " " . $months[date('n', $time)] . " " . date('Y', $time);
	}

	function print_normal_date($datetime) {
		$days = array("", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Minggu");
		$months = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$time = strtotime($datetime);

		$formatted = $days[date('N', $time)] . ", " . date('d', $time) . " " . $months[date('n', $time)] . " " . date('Y', $time);

		return $formatted;
	}

	function get_video_thumbnail($video_url) {
		$filename = basename($video_url);
		$filenames = explode('.', $filename);
		$url = explode('/', $video_url);
		unset($url[count($url)-1]);
		$url = implode('/', $url);
		$url = $url . '/thumb/' . $filenames[0] . '.jpg';

		return $url;
	}

	function admin_route_check() {
		
	}

	function dd($data){
		echo '<pre>';
		print_r($data);
		var_dump($data);
		die();
	}

	function clean_str($string)
	{
		$string = preg_replace('/[^a-zA-Z0-9-_@.\ ]/', '', $string);
		$string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
		return $string;
	}
