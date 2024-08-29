<?php

class AliasTest extends AbstractTest
{
    public function testHelperAlias()
    {
        $helper = Mage::helper('aoe_scheduler');
        $this->assertInstanceOf('Aoe_Scheduler_Helper_Data', $helper);
    }

    public function testShouldReturnScheduleModelFromAlias()
    {
        $model = Mage::getModel('cron/schedule');
        $this->assertInstanceOf('Aoe_Scheduler_Model_Schedule', $model);
    }
}
