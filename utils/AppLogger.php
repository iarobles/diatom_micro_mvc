<?php

/**

 *
 * @author Ismael Ariel
 */
class AppLogger {
    const LEVEL_DEBUG = 4;
    const LEVEL_INFO = 3;
    const LEVEL_WARN = 2;
    const LEVEL_ERROR = 1;
    const LEVEL_NONE = 0;

    private static $debugLevel = self::LEVEL_INFO;
    private static $dateFormat = "Y/m/d H:i:s";
    protected $className;

    function AppLogger($classObject) {
        $this->className = get_class($classObject);
    }

    public static function setDateFormat($dateFormat) {
        self::$dateFormat = $dateFormat;
    }

    public static function setDebugLevel($debugLevel) {
        self::$debugLevel = $debugLevel;
    }

    public static function isDebugEnabled() {
        return (self::$debugLevel == self::LEVEL_DEBUG) ? true : false;
    }

    public static function isInfoEnabled() {
        return (self::$debugLevel == self::LEVEL_INFO) ? true : false;
    }

    public static function isErrorEnabled() {
        return (self::$debugLevel == self::LEVEL_ERROR) ? true : false;
    }

    public static function isWarnEnabled() {
        return (self::$debugLevel == self::LEVEL_WARN) ? true : false;
    }

    public function debug($message) {
        $this->logMessage(self::LEVEL_DEBUG, $message);
    }

    public function info($message) {
        $this->logMessage(self::LEVEL_INFO, $message);
    }

    public function warn($message) {
        $this->logMessage(self::LEVEL_WARN, $message);
    }

    public function error($message) {
        $this->logMessage(self::LEVEL_ERROR, $message);
    }

    protected function logMessage($logLevel, $message) {

        if ($logLevel <= self::$debugLevel) {

            $message = date(self::$dateFormat) . " [" . AppLogger::getLogLevelNameById($logLevel) . "] " . $this->className . ": " . $message . "\n";
            $this->writeMessage($message);
        }
    }

    protected function writeMessage($message) {

        $fileName = ConstManager::getConstant("LOG_FILE_NAME");
        $fileToWrite = fopen($fileName, "a");
        fwrite($fileToWrite, $message);
        fclose($fileToWrite);
    }

    private static function getLogLevelNameById($logLevelId) {
        switch ($logLevelId) {
            case self::LEVEL_ERROR:
                $logLevelName = "error";
                break;
            case self::LEVEL_WARN:
                $logLevelName = "warning";
                break;
            case self::LEVEL_INFO:
                $logLevelName = "info";
                break;
            case self::LEVEL_DEBUG:
                $logLevelName = "debug";
                break;
            default: //LEVEL_NONE
                $logLevelName = "disabled";
                break;
        }

        return $logLevelName;
    }

}

?>
