<?php

namespace MichaelDrennen\Calendar;

use Carbon\Carbon;

class Calendar {

    // Days of the week as
    const SUNDAY    = 0;
    const MONDAY    = 1;
    const TUESDAY   = 2;
    const WEDNESDAY = 3;
    const THURSDAY  = 4;
    const FRIDAY    = 5;
    const SATURDAY  = 6;

    const US_MARKET_OPEN_TIME        = '09:30';
    const US_MARKET_CLOSE_TIME       = '16:00';
    const US_MARKET_EARLY_CLOSE_TIME = '14:00';


    /**
     * @param int $year
     * @return string
     * @throws \Exception
     */
    public static function getEasterForYear( int $year ): string {
        foreach ( Easter::$dates as $date ):
            $datesYear = (int)date( 'Y', strtotime( $date ) );

            if ( $datesYear === $year ):
                return $date;
            endif;
        endforeach;

        throw new \Exception( "Unable to find the date of Easter for the year $year" );
    }


    /**
     * @param int $year
     * @return array
     * @throws \Exception
     */
    public static function getBankHolidaysByYear( int $year ): array {

        $bankHolidays = [];

        // New year's:
        switch ( date( "w", strtotime( "$year-01-01 12:00:00" ) ) ):
            case self::SUNDAY:
                $bankHolidays[] = "$year-01-02";
                break;
            case self::SATURDAY:
                $bankHolidays[] = "$year-01-03";
                break;
            default:
                $bankHolidays[] = "$year-01-01";
        endswitch;


        // Martin Luther King, Jr. Day
        $martinLutherKingJrDay = Carbon::parse( 'third monday of Jan ' . $year );
        $bankHolidays[]        = $martinLutherKingJrDay->format( 'Y-m-d' );

        // Presidents Day
        $presidentsDay  = Carbon::parse( 'third monday of Feb ' . $year );
        $bankHolidays[] = $presidentsDay->format( 'Y-m-d' );

        // Good Friday
        $easter         = self::getEasterForYear( $year );
        $goodFriday     = date( 'Y-m-d', strtotime( "-2 days", strtotime( $easter ) ) );
        $bankHolidays[] = $goodFriday;

        // Memorial Day
        $memorialDay    = Carbon::parse( 'last monday of May ' . $year );
        $bankHolidays[] = $memorialDay->format( 'Y-m-d' );

        // Independence Day
        switch ( date( "w", strtotime( "$year-07-04 12:00:00" ) ) ):
            case self::SUNDAY:
                $bankHolidays[] = "$year-07-05";
                break;
            case self::SATURDAY:
                $bankHolidays[] = "$year-07-03";
                break;
            default:
                $bankHolidays[] = "$year-07-04";
        endswitch;

        // Labor Day
        $laborDay       = Carbon::parse( 'first monday of september ' . $year );
        $bankHolidays[] = $laborDay->format( 'Y-m-d' );

        // Thanksgiving
        $thanksgiving   = Carbon::parse( 'fourth thursday of november ' . $year );
        $bankHolidays[] = $thanksgiving->format( 'Y-m-d' );

        // Day after Thanksgiving
        $di                   = new \DateInterval( 'P1D' );
        $dayAfterThanksgiving = $thanksgiving->add( $di );
        $bankHolidays[]       = $dayAfterThanksgiving->format( 'Y-m-d' );


        // Christmas:
        switch ( date( "w", strtotime( "$year-12-25 12:00:00" ) ) ):
            case self::SUNDAY:
                $bankHolidays[] = "$year-12-26";
                break;
            case self::SATURDAY:
                $bankHolidays[] = "$year-12-24";
                break;
            default:
                $bankHolidays[] = "$year-12-25";
        endswitch;

        // Millennium eve
        if ( $year == 1999 ):
            $bankHolidays[] = "1999-12-31";
        endif;

        return $bankHolidays;
    }

    /**
     * @param Carbon $date
     * @return bool
     * @throws \Exception
     */
    public static function isBankHoliday( Carbon $date ): bool {

        $aBankHolidays = self::getBankHolidaysByYear( $date->year );

        if ( in_array( $date, $aBankHolidays ) ):
            return TRUE;
        endif;

        return FALSE;
    }

    /**
     * @param string $date
     * @return string
     * @throws \Exception
     */
    public static function getLastBusinessDayOfTheMonth( Carbon $date ): string {

        $dateToCheck        = $date->modify("last day of this month");
        $keepLooking = TRUE;

        do {
            if ( self::isWeekday( $dateToCheck ) && !self::isBankHoliday( $dateToCheck ) ) :
                return $date;
            endif;
            $date = date( 'Y-m-d', strtotime( $date . ' -1 day' ) );
        } while ( $keepLooking );

    }

    /**
     * @param string $argDate
     * @return bool
     */
    public static function isWeekend( string $argDate ): bool {
        return ( date( 'N', strtotime( $argDate ) ) >= 6 );
    }


    /**
     * @param string $argDate
     * @return bool
     */
    public static function isWeekday( string $argDate ): bool {
        return !( self::isWeekend( $argDate ) );
    }

    /**
     * @param $argDate
     * @return bool
     * @throws \Exception
     */
    public static function isBusinessDay( $argDate ) {
        if ( self::isWeekend( $argDate ) ):
            return FALSE;
        endif;

        if ( self::isBankHoliday( $argDate ) ):
            return FALSE;
        endif;

        return TRUE;
    }


    /**
     * @param string $anchor
     * @param int $offset
     * @return string
     * @throws \Exception
     */
    public static function getBusinessDateThisManyDaysAway( string $anchor, int $offset ): string {
        $anchor = date( 'Y-m-d', strtotime( $anchor ) );
        if ( $offset == 0 && self::isBusinessDay( $anchor ) ):
            return $anchor;
        elseif ( $offset == 0 ):
            throw new \Exception( "You want to get the next business day zero days away, but $anchor is not a business day." );
        endif;

        if ( $offset > 0 ):
            $offsetDirection = "+";
        else:
            $offsetDirection = "-"; // Look to the past.
            $offset          = abs( $offset );
        endif;

        $counter = 0;
        $newDate = $anchor;
        while ( $counter < $offset ):
            $newDate = date( 'Y-m-d', strtotime( $offsetDirection . "1 day", strtotime( $anchor ) ) );
            $anchor  = $newDate;
            if ( self::isBusinessDay( $newDate ) ):
                //echo "\n$newDate is A business day, so " . ($counter + 1) . " \n";
                $counter++;
            endif;
        endwhile;

        return $newDate;
    }

    public static function getPreviousUSMarketClose( Carbon $date ): Carbon {
        if ( self::isBusinessDay( $date ) ):

        endif;
    }


}