<?php
require_once('../vendor/autoload.php');
require 'TintaSc.class.php';

/**
 * TintaScTest
 * 
 * TintaScTest Test Example
 *
 * Copyright 2015 Jorge Alberto Ponce Turrubiates
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @category   TintaScTest
 * @package    TintaScTest
 * @copyright  Copyright 2015 Jorge Alberto Ponce Turrubiates
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 * @version    1.0.0, 2015-07-16
 * @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)
 */
class TintaScTest extends PHPUnit_Framework_TestCase
{
    protected $tinta;

    /**
     * Setup Test
     */
    protected function setUp() {
    	$this->tinta = TintaSc::getInstance();
    }

    /**
     * TearDown Test
     */
    protected function tearDown() {
        unset($this->tinta);
    }

    /**
     * Test General
     */
    public function testGeneral() {
        $expected = "";

        $event_id = $this->tinta->addEvent(1, '2015-07-30T10:00:00-05:00', '2015-07-30T12:00:00-05:00');;

        if ($event_id != ''){
            $eventKey = $this->tinta->saveEvent("FBID", $event_id);
            
            if ($eventKey == '')
                $event_id = $expected;

            $gFileId = $this->tinta->uploadImg("../numbers.jpg");
            
            if ($gFileId == '')
                $event_id = $expected;

            $this->tinta->saveEventImg($eventKey , $gFileId);

            $this->tinta->addEventUrl($event_id, $eventKey);
        }

        $this->assertNotEquals($expected, $event_id);
    }
}
?>