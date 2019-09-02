<?php

namespace MichaelDrennen\Calendar;

use Carbon\Carbon;

class USMarket {

    /**
     * @var array An array of Carbon objects representing dates the U.S. markets should be close according to SIFMA.
     * @see https://www.sifma.org/resources/general/holiday-schedule/
     */
    protected $sifmaClosedDates = [];

    /**
     * @var array An array of Carbon objects representing dates the U.S. markets should be closing early according to SIFMA.
     * @see https://www.sifma.org/resources/general/holiday-schedule/
     */
    protected $sifmaEarlyCloseDates = [];


    public function __construct() {
        $this->_setSifmaClosedDates();
        $this->_setSifmaEarlyCloseDates();
    }

    /**
     *
     */
    protected function _setSifmaClosedDates() {
        $this->sifmaClosedDates = [

            "New Year's Day 2019"         => Carbon::create( 2019, 1, 1 ),
            "Martin Luther King Day 2019" => Carbon::create( 2019, 1, 21 ),
            "Presidents Day 2019"         => Carbon::create( 2019, 2, 18 ),
            "Good Friday 2019"            => Carbon::create( 2019, 4, 19 ),
            "Memorial Day 2019"           => Carbon::create( 2019, 5, 27 ),
            "U.S. Independence Day 2019"  => Carbon::create( 2019, 7, 4 ),
            "Labor Day 2019"              => Carbon::create( 2019, 9, 2 ),
            "Columbus Day 2019"           => Carbon::create( 2019, 10, 14 ),
            "Veterans Day 2019"           => Carbon::create( 2019, 11, 11 ),
            "Thanksgiving Day 2019"       => Carbon::create( 2019, 11, 28 ),
            "Christmas Day 2019"          => Carbon::create( 2019, 12, 25 ),

            "New Year's Day 2020"         => Carbon::create( 2020, 1, 1 ),
            "Martin Luther King Day 2020" => Carbon::create( 2020, 1, 20 ),
            "Presidents Day 2020"         => Carbon::create( 2020, 2, 17 ),
            "Good Friday 2020"            => Carbon::create( 2020, 4, 10 ),
            "Memorial Day 2020"           => Carbon::create( 2020, 5, 25 ),
            "U.S. Independence Day 2020"  => Carbon::create( 2020, 7, 3 ),
            "Labor Day 2020"              => Carbon::create( 2020, 9, 7 ),
            "Columbus Day 2020"           => Carbon::create( 2020, 10, 12 ),
            "Veterans Day 2020"           => Carbon::create( 2020, 11, 11 ),
            "Thanksgiving Day 2020"       => Carbon::create( 2020, 11, 26 ),
            "Christmas Day 2020"          => Carbon::create( 2020, 12, 25 ),

            "New Year's Day 2021" => Carbon::create( 2021, 1, 1 ),
        ];
    }

    protected function _setSifmaEarlyCloseDates() {
        $this->sifmaEarlyCloseDates = [
            "New Year's Eve 2018" => Carbon::create( 2018, 12, 31, 14, 0, 0, 'America/New_York' ),

            "Good Friday Eve 2019"           => Carbon::create( 2019, 4, 18, 14, 0, 0, 'America/New_York' ),
            "Memorial Day Eve 2019"          => Carbon::create( 2019, 5, 24, 14, 0, 0, 'America/New_York' ),
            "U.S. Independence Day Eve 2019" => Carbon::create( 2019, 7, 3, 14, 0, 0, 'America/New_York' ),
            "Thanksgiving Eve 2019"          => Carbon::create( 2019, 11, 29, 14, 0, 0, 'America/New_York' ),
            "Christmas 2019"                 => Carbon::create( 2019, 12, 24, 14, 0, 0, 'America/New_York' ),
            "New Year's Eve 2019"            => Carbon::create( 2019, 12, 31, 14, 0, 0, 'America/New_York' ),

            "Good Friday Eve 2020"           => Carbon::create( 2020, 4, 9, 14, 0, 0, 'America/New_York' ),
            "Memorial Day Eve 2020"          => Carbon::create( 2020, 5, 22, 14, 0, 0, 'America/New_York' ),
            "U.S. Independence Day Eve 2020" => Carbon::create( 2020, 7, 2, 14, 0, 0, 'America/New_York' ),
            "Thanksgiving Eve 2020"          => Carbon::create( 2020, 11, 27, 14, 0, 0, 'America/New_York' ),
            "Christmas 2020"                 => Carbon::create( 2020, 12, 24, 14, 0, 0, 'America/New_York' ),
            "New Year's Eve 2020"            => Carbon::create( 2020, 12, 31, 14, 0, 0, 'America/New_York' ),
        ];
    }


    public function isUSMarketOpen(Carbon $date): bool {
        if(in_array($this->sifmaClosedDates)):
            return false;
        endif;

        if(Calendar::isWeekend($date->toDateString()))
    }
}