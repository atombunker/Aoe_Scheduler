<?php

/**
 * Scheduler API
 *
 * @author Fabrizio Branca
 */
class Aoe_Scheduler_Model_Api extends Mage_Api_Model_Resource_Abstract
{
    /**
     * Run task
     *
     * @return array
     */
    public function runNow($code)
    {
        if (! Mage::getStoreConfig('system/cron/enableRunNow')) {
            Mage::throwException("'Run now' disabled by configuration (system/cron/enableRunNow)");
        }

        $schedule = Mage::getModel('cron/schedule')/** @var Aoe_Scheduler_Model_Schedule $schedule */
            ->setJobCode($code)
            ->setScheduledReason(Aoe_Scheduler_Model_Schedule::REASON_RUNNOW_API)
            ->runNow(false) // without trying to lock the job
            ->save();

        return $schedule->getData();
    }

    /**
     * Schedule task
     *
     * @param null $time
     * @return array
     */
    public function schedule($code, $time = null)
    {
        $schedule = Mage::getModel('cron/schedule')/** @var Aoe_Scheduler_Model_Schedule $schedule */
            ->setJobCode($code)
            ->setScheduledReason(Aoe_Scheduler_Model_Schedule::REASON_SCHEDULENOW_API)
            ->schedule($time)
            ->save();
        return $schedule->getData();
    }

    /**
     * Get info
     *
     * @return string
     */
    public function info($id)
    {
        $schedule = Mage::getModel('cron/schedule')->load($id); /** @var Aoe_Scheduler_Model_Schedule $schedule */
        return $schedule->getData();
    }
}
