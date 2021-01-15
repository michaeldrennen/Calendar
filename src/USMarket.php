<?php

namespace MichaelDrennen\Calendar;

use Carbon\Carbon;
use Exception;

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

    protected $normalMarketOpenHourEst    = '9';
    protected $normalMarketOpenMinuteEst  = '30';
    protected $normalMarketCloseHourEst   = '16';
    protected $normalMarketCloseMinuteEst = '0';


    /**
     * USMarket constructor.
     */
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

            "New Year's Day 2021"         => Carbon::create( 2021, 1, 1 ),
            "Martin Luther King Day 2021" => Carbon::create( 2021, 1, 18 ),
            "Presidents Day 2021"         => Carbon::create( 2021, 2, 15 ),
            "Good Friday 2021"            => Carbon::create( 2021, 4, 2 ),
            "Memorial Day 2021"           => Carbon::create( 2021, 5, 31 ),
            "U.S. Independence Day 2021"  => Carbon::create( 2021, 7, 5 ),
            "Labor Day 2021"              => Carbon::create( 2021, 9, 6 ),
            "Columbus Day 2021"           => Carbon::create( 2021, 10, 11 ),
            "Veterans Day 2021"           => Carbon::create( 2021, 11, 11 ),
            "Thanksgiving Day 2021"       => Carbon::create( 2021, 11, 25 ),
            "Christmas Day 2021"          => Carbon::create( 2021, 12, 24 ),

            "New Year's Day 2022"         => Carbon::create( 2022, 1, 1 ),
            "Martin Luther King Day 2022" => Carbon::create( 2022, 1, 17 ),
            "Presidents Day 2022"         => Carbon::create( 2022, 2, 21 ),
            "Good Friday 2022"            => Carbon::create( 2022, 4, 15 ),
            "Memorial Day 2022"           => Carbon::create( 2022, 5, 30 ),
            "U.S. Independence Day 2022"  => Carbon::create( 2022, 7, 4 ),
            "Labor Day 2022"              => Carbon::create( 2022, 9, 5 ),
            "Columbus Day 2022"           => Carbon::create( 2022, 10, 10 ),
            "Veterans Day 2022"           => Carbon::create( 2022, 11, 11 ),
            "Thanksgiving Day 2022"       => Carbon::create( 2022, 11, 24 ),
            "Christmas Day 2022"          => Carbon::create( 2022, 12, 26 ),

            "New Year's Day 2023"         => Carbon::create( 2023, 1, 2 ),
        ];
    }


    /**
     *
     */
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

            "Good Friday Eve 2021"           => Carbon::create( 2021, 4, 2, 14, 0, 0, 'America/New_York' ),
            "Memorial Day Eve 2021"          => Carbon::create( 2021, 5, 28, 14, 0, 0, 'America/New_York' ),
            "U.S. Independence Day Eve 2021" => Carbon::create( 2021, 7, 2, 14, 0, 0, 'America/New_York' ),
            "Thanksgiving Eve 2021"          => Carbon::create( 2021, 11, 26, 14, 0, 0, 'America/New_York' ),
            "Christmas 2021"                 => Carbon::create( 2021, 12, 23, 14, 0, 0, 'America/New_York' ),
            "New Year's Eve 2021"            => Carbon::create( 2021, 12, 31, 14, 0, 0, 'America/New_York' ),

            "Good Friday Eve 2022"           => Carbon::create( 2022, 4, 14, 14, 0, 0, 'America/New_York' ),
            "Memorial Day Eve 2022"          => Carbon::create( 2022, 5, 27, 14, 0, 0, 'America/New_York' ),
            "U.S. Independence Day Eve 2022" => Carbon::create( 2022, 7, 1, 14, 0, 0, 'America/New_York' ),
            "Thanksgiving Eve 2022"          => Carbon::create( 2022, 11, 25, 14, 0, 0, 'America/New_York' ),
            "Christmas 2022"                 => Carbon::create( 2022, 12, 23, 14, 0, 0, 'America/New_York' ),
            "New Year's Eve 2022"            => Carbon::create( 2022, 12, 30, 14, 0, 0, 'America/New_York' ),
        ];
    }


    /**
     * @param Carbon $date
     * @return bool
     */
    public function isSifmaClosedDate( Carbon $date ): bool {
        $closedMatches = array_filter( $this->sifmaClosedDates, function ( $closedDate ) use ( $date ) {
            return $date->toDateString() === $closedDate->toDateString();
        } );

        if ( empty( $closedMatches ) ):
            return FALSE;
        endif;
        return TRUE;
    }


    /**
     * @param Carbon $date
     * @return Carbon
     */
    public function isSifmaEarlyCloseDate( Carbon $date ): ?Carbon {
        $earlyCloseMatches = array_filter( $this->sifmaEarlyCloseDates, function ( $earlyCloseDate ) use ( $date ) {
            return $date->toDateString() === $earlyCloseDate->toDateString();
        } );

//        if ( empty( $earlyCloseMatches ) ):
//            throw new Exception( "This is not an early close date according to SIFMA." );
//        endif;

        if ( empty( $earlyCloseMatches ) ):
            return NULL;
        endif;


        return reset( $earlyCloseMatches );
    }

    public function isUSTradingDate( Carbon $date ): bool {
        // No trading on the weekends.
        if ( Calendar::isWeekend( $date ) ):
            return FALSE;
        endif;

        // If today should be closed according to SIFMA.
        if ( $this->isSifmaClosedDate( $date ) ):
            return FALSE;
        endif;

        return TRUE;
    }


    /**
     * @param Carbon $dateTime
     * @return bool
     */
    public function isUSTradingDateDuringMarketHours( Carbon $dateTime ): bool {
        if ( FALSE === $this->isUSTradingDate( $dateTime ) ):
            return FALSE;
        endif;

        if ( FALSE === $this->isDuringTradingHours( $dateTime ) ):
            return FALSE;
        endif;

        return TRUE;
    }

    /**
     * @param Carbon $dateTime
     * @return bool
     */
    public function isBeforeTradingHours( Carbon $dateTime ): bool {
        $startOfTradingThisDay = $dateTime->copy();
        $startOfTradingThisDay->setHour( $this->normalMarketOpenHourEst );
        $startOfTradingThisDay->setMinute( $this->normalMarketOpenMinuteEst );
        if ( $dateTime->lt( $startOfTradingThisDay ) ):
            return TRUE;
        endif;
        return FALSE;
    }


    /**
     * @param Carbon $dateTime
     * @return bool
     */
    public function isAfterTradingHours( Carbon $dateTime ): bool {
        $earlyCloseDate = $this->isSifmaEarlyCloseDate( $dateTime );
        if ( $earlyCloseDate && $dateTime->gt( $earlyCloseDate ) ):
            return TRUE;
        endif;

        $endOfTradingThisDay = $dateTime->copy();
        $endOfTradingThisDay->setHour( $this->normalMarketCloseHourEst );
        $endOfTradingThisDay->setMinute( $this->normalMarketCloseMinuteEst );
        if ( $dateTime->gt( $endOfTradingThisDay ) ):
            return TRUE;
        endif;
        return FALSE;
    }


    /**
     * @param Carbon $dateTime
     * @return bool
     */
    public function isDuringTradingHours( Carbon $dateTime ): bool {
        if ( $this->isBeforeTradingHours( $dateTime ) ):
            return FALSE;
        endif;

        if ( $this->isAfterTradingHours( $dateTime ) ):
            return FALSE;
        endif;

        return TRUE;
    }


    /**
     * @param Carbon $dateTime
     * @return bool
     */
    public function isUSMarketOpen( Carbon $dateTime ): bool {
        // No trading on the weekends.
        if ( Calendar::isWeekend( $dateTime ) ):
            return FALSE;
        endif;

        // If today should be closed according to SIFMA.
        if ( $this->isSifmaClosedDate( $dateTime ) ):
            return FALSE;
        endif;

        // Is it before market open time today?
        $marketOpensToday = $dateTime->copy();
        $marketOpensToday->setHour( $this->normalMarketOpenHourEst );
        $marketOpensToday->setMinute( $this->normalMarketOpenMinuteEst );

        // If it's before normal market opening time, return false.
        if ( $dateTime->lt( $marketOpensToday ) ):
            return FALSE;
        endif;

        // If today is an early close day according to SIFMA...

        if ( $earlyCloseDateTime = $this->isSifmaEarlyCloseDate( $dateTime ) ):
            $marketClosesToday = $earlyCloseDateTime;
        else:
            // Else today is a trading day with a normal closing time.
            $marketClosesToday = $dateTime->copy();
            $marketClosesToday->setHour( $this->normalMarketCloseHourEst );
            $marketClosesToday->setMinute( $this->normalMarketCloseMinuteEst );
        endif;


        // If it's after closing time (early or normal), return false.
        if ( $dateTime->gt( $marketClosesToday ) ):
            return FALSE;
        endif;

        // Every reason why the market might get closed has been exhausted.
        // The market must be open.
        return TRUE;
    }


    public function getPreviousTradingDay( Carbon $date ): Carbon {
        $keepLooking = TRUE;
        $date->setHour( 12 );
        $date->setMinute( 0 );
        $date->setSecond( 0 );
        $currentDate = $date->copy()->subDay();
        do {
            if ( $this->isUSTradingDate( $currentDate ) ):
                return $currentDate;
            else:
                $currentDate->subDay();
            endif;
        } while ( $keepLooking );
    }


    public function getNextTradingDay( Carbon $date ): Carbon {
        $keepLooking = TRUE;
        $date->setHour( 12 );
        $date->setMinute( 0 );
        $date->setSecond( 0 );
        $currentDate = $date->copy()->addDay();
        do {
            if ( $this->isUSTradingDate( $currentDate ) ):
                return $currentDate;
            else:
                $currentDate->addDay();
            endif;
        } while ( $keepLooking );
    }


    public function getPreviousTradingDaysOpen( Carbon $date ): Carbon {
        $previousTradingDay = $this->getPreviousTradingDay( $date );
        $previousTradingDay->setHour( $this->normalMarketOpenHourEst );
        $previousTradingDay->setMinute( $this->normalMarketOpenMinuteEst );
        return $previousTradingDay;
    }

    public function getPreviousTradingDaysClose( Carbon $date ): Carbon {
        $previousTradingDay = $this->getPreviousTradingDay( $date );

        if ( $earlyClose = $this->isSifmaEarlyCloseDate( $date ) ):
            return $earlyClose;
        endif;

        $previousTradingDay->setHour( $this->normalMarketCloseHourEst );
        $previousTradingDay->setMinute( $this->normalMarketCloseMinuteEst );
        return $previousTradingDay;
    }

    public function getNextTradingDaysOpen( Carbon $date ): Carbon {
        $nextTradingDay = $this->getNextTradingDay( $date );
        $nextTradingDay->setHour( $this->normalMarketOpenHourEst );
        $nextTradingDay->setMinute( $this->normalMarketOpenMinuteEst );
        return $nextTradingDay;
    }

    public function getNextTradingDaysClose( Carbon $date ): Carbon {
        $nextTradingDay = $this->getNextTradingDay( $date );

        if ( $earlyClose = $this->isSifmaEarlyCloseDate( $date ) ):
            return $earlyClose;
        endif;

        $nextTradingDay->setHour( $this->normalMarketCloseHourEst );
        $nextTradingDay->setMinute( $this->normalMarketCloseMinuteEst );
        return $nextTradingDay;
    }


    public function getPreviousMarketClose( Carbon $dateTime ): Carbon {
        // IF: Its a trading day, but before trading has begun
        // ELSE: It's a trading day, and during trading hours.
        // ELSE: It's not a trading day
        // SO: I return the previous trading day's close.
        if ( $this->isUSTradingDate( $dateTime ) && $this->isBeforeTradingHours( $dateTime ) ):
        elseif ( $this->isUSTradingDate( $dateTime ) && $this->isDuringTradingHours( $dateTime ) ):
        elseif ( FALSE === $this->isUSTradingDate( $dateTime ) ):
            $previousTradingDay = $this->getPreviousTradingDay( $dateTime );
            if ( $earlyCloseDay = $this->isSifmaEarlyCloseDate( $previousTradingDay ) ):
                return $earlyCloseDay;
            else:
                return $this->getPreviousTradingDaysClose( $dateTime );
            endif;
        endif;
        // ELSE: After hours on a trading day.
        // SO: I return this days close.
        $dateTime->setHour( $this->normalMarketCloseHourEst );
        $dateTime->setMinute( $this->normalMarketCloseMinuteEst );
        return $dateTime;
    }

    public function getPreviousMarketOpen( Carbon $dateTime ): Carbon {
        if ( $this->isUSMarketOpen( $dateTime ) ):
            $previousTradingDay = $this->getPreviousTradingDay( $dateTime );
            if ( $earlyCloseDay = $this->isSifmaEarlyCloseDate( $previousTradingDay ) ):
                return $earlyCloseDay;
            else:
                return $previousTradingDay;
            endif;
        endif;
    }
}