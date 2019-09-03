<?php

use PHPUnit\Framework\TestCase;
use MichaelDrennen\Calendar\Calendar;
use Carbon\Carbon;

class CalendarTest extends TestCase {

    /**
     * @test
     */
    public function testIsBusinessDate() {
        $aBusinessDay   = Carbon::create( 2019, 8, 20, 12, 0, 0, 'America/New_York' );
        $isBusinessDay = Calendar::isBusinessDay( $aBusinessDay );
        $this->assertTrue( $isBusinessDay );
    }

    /**
     * @test
     */
    public function testIsNotBusinessDay() {
        $notBusinessDay   = Carbon::create( 2019, 8, 18, 12, 0, 0, 'America/New_York' );
        $isBusinessDay  = Calendar::isBusinessDay( $notBusinessDay );
        $this->assertFalse( $isBusinessDay );

        $notBusinessDay   = Carbon::create( 2019, 7, 4, 12, 0, 0, 'America/New_York' );
        $isBusinessDay  = Calendar::isBusinessDay( $notBusinessDay );
        $this->assertFalse( $isBusinessDay );
    }

    /**
     * @test
     */
    public function testIsBankHoliday() {
        $bankHoliday   = Carbon::create( 2019, 7, 4, 12, 0, 0, 'America/New_York' );
        $isBankHoliday = Calendar::isBankHoliday( $bankHoliday );
        $this->assertTrue( $isBankHoliday );
    }

    /**
     * @test
     */
    public function testOutOfRangeEasterThrowsException() {
        $easter1899 = 1899;
        $this->expectExceptionMessage( "Unable to find the date of Easter for the year " . $easter1899 );
        $getEaster1899 = Calendar::getEasterForYear( $easter1899 );
        echo "You should not ever see: $getEaster1899 since exception should have been thrown.";
    }

    /**
     * @test
     */
    public function testSwitchCasesAreIncludedInBankHolidaysByYearArray() {
        $year         = 2023;
        $bankHolidays = Calendar::getBankHolidaysByYear( $year );
        $this->assertContains( "$year-01-02", $bankHolidays );

        $year         = 2022;
        $bankHolidays = Calendar::getBankHolidaysByYear( $year );
        $this->assertContains( "$year-01-03", $bankHolidays );

        $year         = 2021;
        $bankHolidays = Calendar::getBankHolidaysByYear( $year );
        $this->assertContains( "$year-07-05", $bankHolidays );

        $year         = 2020;
        $bankHolidays = Calendar::getBankHolidaysByYear( $year );
        $this->assertContains( "$year-07-03", $bankHolidays );

        $year         = 1999;
        $bankHolidays = Calendar::getBankHolidaysByYear( $year );
        $this->assertContains( "$year-12-31", $bankHolidays );
    }

    /**
     * @test
     */
    public function testGetLastBusinessDayOfMonthIsAugThirty2019() {
        $inputDate              = Carbon::create( 2019, 8, 1 );
        $expectedDate           = Carbon::create( 2019, 8, 30 );
        $lastBusinessDayOfMonth = Calendar::getLastBusinessDayOfTheMonth( $inputDate );
        $this->assertEquals( $lastBusinessDayOfMonth, $expectedDate );
    }


    /**
     * @test
     * @group tt
     */
    public function testBusinessDateOffsetDaysAwayIsExpectedBusinessDate() {
        $offset               = 4;
        $anchorDate           = Carbon::create( 2019, 8, 26, 12, 0, 0, 'America/New_York' );
        $expectedBusinessDate = Carbon::create( 2019, 8, 30, 12, 0, 0, 'America/New_York' );
        $businessDate         = Calendar::getBusinessDateThisManyDaysAway( $anchorDate, $offset );
        $this->assertTrue( $businessDate->eq( $expectedBusinessDate ) );

        $offset               = 0;
        $expectedBusinessDate = $anchorDate;
        $businessDate         = Calendar::getBusinessDateThisManyDaysAway( $anchorDate, $offset );
        $this->assertTrue( $businessDate->eq( $expectedBusinessDate ) );

        $offset               = -4;
        $expectedBusinessDate = Carbon::create( 2019, 8, 20, 12, 0, 0, 'America/New_York' );
        $businessDate         = Calendar::getBusinessDateThisManyDaysAway( $anchorDate, $offset );

        $this->assertTrue( $businessDate->eq( $expectedBusinessDate ) );
    }

    /**
     * @test
     */
    public function testBusinessDateOffsetZeroDaysAwayThrowsException() {
        $offset     = 0;
        $anchorDate = Carbon::create( 2019, 8, 31 );
        $this->expectExceptionMessage( "You want to get the next business day zero days away, but " . $anchorDate->toDateString() . " is not a business day." );
        $businessDate = Calendar::getBusinessDateThisManyDaysAway( $anchorDate, $offset );
        echo "You should not ever see: $businessDate since exception should have been thrown.";
    }


}