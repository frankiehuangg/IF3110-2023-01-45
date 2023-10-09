<?php

class Logger {
    protected static $log_file;
    protected static $file;
    protected static $options = [
        'date_format' => 'd-M-Y',
        'log_format' => 'H:i:s d-M-Y'
    ];
    private static $instance;
    private static $log_dir = PROJECT_ROOT_PATH . '/logs';

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function createLogFile() {
        $time = date(static::$options['date_format']);
        static::$log_file = static::$log_dir . "/log-{$time}.txt";

        if (!file_exists(static::$log_dir)) {
            mkdir(static::$log_dir, 0777, true);
        }

        if (!file_exists(static::$log_file)) {
            fopen(static::$log_file, 'w') or exit("Can't create log file!");
        }

        if (!is_writable(static::$log_file)) {
            throw new Exception('Error: Unable to write to file!', 1);
        }
    }

    public static function debug($message, $context = []) {
        $bt = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1);

        static::writeLog([
            'message'   => $message,
            'bt'        => $bt,
            'severity'  => 'DEBUG',
            'context'   => $context
        ]);
    }

    public static function writeLog($args = []) {
        static::createLogFile();

        if (!is_resource(static::$file)) {
            static::openLog();
        }

        $time = date(static::$options['log_format']);

        $context = json_encode($args['context']);

        $caller = array_shift($args['bt']);
        $bt_line = $caller['line'];
        $bt_path = $caller['file'];

        $path = static::absToRelPath($bt_path);

        $time_log       = is_null($time) ?              '[N/A] ' : "[{$time}] ";
        $path_log       = is_null($path) ?              '[N/A] ' : "[{$path}] ";
        $line_log       = is_null($bt_line) ?           '[N/A] ' : "[{$bt_line}] ";
        $severity_log   = is_null($args['severity']) ?  '[N/A] ' : "[{$args['severity']}] ";
        $message_log    = is_null($args['message']) ?   'N/A' : "{$args['message']}";
        $context_log    = is_null($args['context']) ?   '' : "{$context} ";
        
        fwrite(static::$file, "{$time_log}{$path_log}{$line_log}: {$severity_log} - {$message_log} {$context_log}" . PHP_EOL);

        static::closeFile();
    }

    private static function openLog() {
        $open_file = static::$log_file;
        static::$file = fopen($open_file, 'a') or exit("Can't open $open_file!");
    }

    public static function closeFile() {
        if (static::$file) {
            fclose(static::$file);
        }
    }

    protected function __construct() {
    }

    public static function absToRelPath($path_to_convert) {
        $abs_path = str_replace(['/', '\\'], '/', $path_to_convert);
        $document_root = str_replace(['/', '\\'], '/', $_SERVER['DOCUMENT_ROOT']);

        return $_SERVER['SERVER_NAME'] . str_replace($document_root, '', $abs_path);
    }
};

?>