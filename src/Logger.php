<?php
/**
 * Created by PhpStorm.
 * User: LAZHCM10329
 * Date: 1/16/17
 * Time: 11:37 AM
 */

namespace Tradeshift\Interview;

use Monolog;
use Monolog\Handler\StreamHandler;

class Logger
{
    protected static $_instance = null;
    protected $_log = null;

    protected function __construct()
    {
        $log = new Monolog\Logger('error');
        $log->pushHandler(new StreamHandler('logs/error.log', Monolog\Logger::ERROR));
        $this->_log = $log;
    }

    /**
     * @return \Monolog\Logger|null
     */
    public function getLogger()
    {
        return $this->_log;
    }

    /**
     * @param $message
     * @param array $context
     * @param array $additionalData
     */
    public function error($message, array $context = array(), array $additionalData = [])
    {
        $this->log(Monolog\Logger::ERROR, $message, $context, $additionalData);
    }

    /**
     * @param $level
     * @param $message
     * @param array $context
     * @param array $additionalData
     */
    public function log($level, $message, array $context = array(), array $additionalData = [])
    {
        if (!isset($context['additional_data'])) {
            $context['additional_data'] = [];
        }

        $context['additional_data'] += $additionalData;

        //$context += $this->getContext();

        if (empty($context['additional_data'])) {
            $context['additional_data'] = [];
        }

        //$message = $this->_prepare($message);

        $this->getLogger()->addRecord($level, $message, $context);
    }

    /**
     * @return Logger
     */
    public static function getInstance()
    {
        if (static::$_instance === null) {
            static::$_instance = new Logger();
        }

        return static::$_instance;
    }
}