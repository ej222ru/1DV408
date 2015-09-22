<?php

class DateTimeView {


	public function show() {

		$timeString = date("l") .", the " .date("j") ."nd of " .date("F") .date(" Y") . ", The time is " .date("His");

		return '<p>' . $timeString . '</p>';
	}
}