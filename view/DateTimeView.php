<?php

class DateTimeView {

    /*
     * show()Creates a date and time string on the format 
     * Wednesday, the 23rd of September 2015, The time is 18:07:07
     */
    public function show() {
            date_default_timezone_set("Europe/Stockholm");
            $timeString = date("l") .", the " .date("jS") ." of " .date("F") .date(" Y") . ", The time is " .date("H:i:s");

            return '<p>' . $timeString . '</p>';
    }
}