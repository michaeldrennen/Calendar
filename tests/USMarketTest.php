<?php

use PHPUnit\Framework\TestCase;
use MichaelDrennen\Calendar\USMarket;
use Carbon\Carbon;

class USMarketTest extends TestCase {

    /**
     * @test
     * @group us
     */
    public function testMarketShouldBeClosed() {
        $date = Carbon::create( 2019, 4, 18, 14, 1, 0, 'America/New_York' );
        $usMarket     = new USMarket();
        $marketIsOpen = $usMarket->isUSMarketOpen( $date );
        $this->assertFalse( $marketIsOpen );
    }

    /**
     * @test
     * @group us
     */
    public function testMarketShouldBeOpen() {
        $date = Carbon::create( 2019, 9, 3, 12, 0, 0, 'America/New_York' );
        $usMarket     = new USMarket();
        $marketIsOpen = $usMarket->isUSMarketOpen( $date );
        $this->assertTrue( $marketIsOpen );
    }

    /**
     * @test
     * @group us
     */
    public function testMarketShouldBeClosedAfterMarketClose() {
        $date = Carbon::create( 2019, 9, 3, 23, 0, 0, 'America/New_York' );
        $usMarket     = new USMarket();
        $marketIsOpen = $usMarket->isUSMarketOpen( $date );
        $this->assertFalse( $marketIsOpen );
    }


    /**
     * @test
     * @group us
     */
    public function testMarketShouldBeClosedBecauseWeekend() {
        $date = Carbon::create( 2019, 9, 1, 12, 0, 0, 'America/New_York' );
        $usMarket     = new USMarket();
        $marketIsOpen = $usMarket->isUSMarketOpen( $date );
        $this->assertFalse( $marketIsOpen );
    }


    /**
     * @test
     * @group us
     */
    public function testMarketShouldBeClosedBecauseSifmaSaysSo() {
        $date = Carbon::create( 2019, 9, 2, 12, 0, 0, 'America/New_York' );
        $usMarket     = new USMarket();
        $marketIsOpen = $usMarket->isUSMarketOpen( $date );
        $this->assertFalse( $marketIsOpen );
    }


    /**
     * @test
     * @group us
     */
    public function testMarketShouldBeClosedBecauseBeforeMarketOpen() {
        $date = Carbon::create( 2019, 9, 3, 2, 0, 0, 'America/New_York' );
        $usMarket     = new USMarket();
        $marketIsOpen = $usMarket->isUSMarketOpen( $date );
        $this->assertFalse( $marketIsOpen );
    }

}