<?php


namespace Jpc\LogRotation\Cron;

class LogRotation{

    protected $filesystemIo;
    protected $filesystem;
    protected $browser;

    public function __construct(
        \Magento\Framework\Filesystem\Io\File $filesystemIo,
        \Magento\Framework\Filesystem\Driver\File $browser,
        \Magento\Framework\App\Filesystem\DirectoryList $filesystem
    ){
        $this->filesystemIo = $filesystemIo;
        $this->browser = $browser;
        $this->filesystem = $filesystem;
    }

    /**
     * Execute the cron
     *
     * @return void
     */
    public function execute(){


        $year = date('Y');
        $month = date('m');
        $day = date('d');

        $log = $this->filesystem->getPath('var').'/log';
        $backupLog = $this->filesystem->getPath('var').'/backup/log/'.$year.'/'.$month.'/'.$day;

        try{
            $this->filesystemIo->mkdir($backupLog, 0775);
            $files = $this->browser->readDirectoryRecursively($log);
            foreach($files as $file){
                $action = $this->filesystemIo->mv($file, $backupLog.'/'.basename($file));
            }
        }catch(Exception $e){
            die($e->getMessage());
        }

        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/Acidgreen_LogRotation.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);

        $logger->info("Cronjob LogRotation is executed : ".$backupLog);
    }
}
