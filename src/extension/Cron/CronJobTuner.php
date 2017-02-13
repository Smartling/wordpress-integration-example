<?php

namespace Smartling\Extensions\Cron;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class CronJobTuner
 */
class CronJobTuner
{
    /**
     * @var The minimum TTL for Upload job in seconds.
     */
    private $uploadJobTTL;

    /**
     * @var The minimum TTL for Submission Collector job in seconds.
     */
    private $submissionCollectorJobTTL;

    /**
     * @var The minimum TTL for Last Modified check job in seconds.
     */
    private $lastModifiedJobTTL;

    /**
     * @var The minimum TTL for Download job in seconds.
     */
    private $downloadJobTTL;

    /**
     * @var ContainerBuilder
     */
    private $di;

    /**
     * @return The Upload cron Job TTL
     */
    public function getUploadJobTTL()
    {
        return $this->uploadJobTTL;
    }

    /**
     * @param The $uploadJobTTL
     *
     * @return CronJobTuner
     */
    public function setUploadJobTTL($uploadJobTTL)
    {
        $this->uploadJobTTL = (int)$uploadJobTTL;

        return $this;
    }

    /**
     * @return The Submission Collector cron Job TTL
     */
    public function getSubmissionCollectorJobTTL()
    {
        return $this->submissionCollectorJobTTL;
    }

    /**
     * @param The $submissionCollectorJobTTL
     *
     * @return CronJobTuner
     */
    public function setSubmissionCollectorJobTTL($submissionCollectorJobTTL)
    {
        $this->submissionCollectorJobTTL = (int)$submissionCollectorJobTTL;

        return $this;
    }

    /**
     * @return The Last Modified cron Job TTL
     */
    public function getLastModifiedJobTTL()
    {
        return $this->lastModifiedJobTTL;
    }

    /**
     * @param The $lastModifiedJobTTL
     *
     * @return CronJobTuner
     */
    public function setLastModifiedJobTTL($lastModifiedJobTTL)
    {
        $this->lastModifiedJobTTL = (int)$lastModifiedJobTTL;

        return $this;
    }

    /**
     * @return The Download cron Job TTL
     */
    public function getDownloadJobTTL()
    {
        return $this->downloadJobTTL;
    }

    /**
     * @param The $downloadJobTTL
     *
     * @return CronJobTuner
     */
    public function setDownloadJobTTL($downloadJobTTL)
    {
        $this->downloadJobTTL = (int)$downloadJobTTL;

        return $this;
    }

    /**
     * @return ContainerBuilder
     */
    public function getDi()
    {
        return $this->di;
    }

    /**
     * @param ContainerBuilder $di
     */
    public function setDi(ContainerBuilder $di)
    {
        $this->di = $di;
    }

    /**
     * CronJobTuner constructor.
     *
     * @param ContainerBuilder $di
     */
    public function __construct(ContainerBuilder $di)
    {
        $this->setDi($di);
        $this->read();
    }

    private function readWorkerInterval($workerName)
    {
        return $this->getDi()->get($workerName)->getJobRunInterval();
    }

    private function writeWorkerInterval($workerName, $interval)
    {
        return $this->getDi()->get($workerName)->setJobRunInterval((int)$interval);
    }

    /**
     * Reads runtime setting from di
     */
    private function read()
    {
        $this->setUploadJobTTL($this->readWorkerInterval('cron.worker.upload'));
        $this->setSubmissionCollectorJobTTL($this->readWorkerInterval('cron.worker.submission-collector'));
        $this->setLastModifiedJobTTL($this->readWorkerInterval('cron.worker.last-modified-check'));
        $this->setDownloadJobTTL($this->readWorkerInterval('cron.worker.download'));
    }

    /**
     * Applies new runtime settings
     */
    public function apply()
    {
        $this->writeWorkerInterval('cron.worker.upload', $this->getUploadJobTTL());
        $this->writeWorkerInterval('cron.worker.submission-collector', $this->getSubmissionCollectorJobTTL());
        $this->writeWorkerInterval('cron.worker.last-modified-check', $this->getLastModifiedJobTTL());
        $this->writeWorkerInterval('cron.worker.download', $this->getDownloadJobTTL());
    }
}