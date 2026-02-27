<?php
/**

 *
 * @see 
 *
 * @author    
 * @author    
 * @author    
 * @author    
 * @copyright 
 * @copyright 
 * @copyright 
 * @license   

 */

namespace PHPMailer\PHPMailer;

/**

 * @author 
 * @author 
 * @author 
 * @author 
 */
class POP3
{
    /**
     
     
     * @var string
     */
    const VERSION = '6.1.8';

    /**
     
     *
     * @var int
     */
    const DEFAULT_PORT = 110;

    /**
    
     *
     * @var int
     */
    const DEFAULT_TIMEOUT = 30;

    /**
     
     *
     * @var int
     */
    public $do_debug = 0;

    /**
     
     * @var string
     */
    public $host;

    /**
     
     * @var int
     */
    public $port;

    /**
     
     * @var int
     */
    public $tval;

    /**
     
     * @var string
     */
    public $username;

    /**
     * POP3 password.
     *
     * @var string
     */
    public $password;

    /**
     
     * @var resource
     */
    protected $pop_conn;

    /**
     
     * @var bool
     */
    protected $connected = false;

    /**
     * Error container.
     *
     * @var array
     */
    protected $errors = [];

    /**
     * Line break constant.
     */
    const LE = "\r\n";

    /**
     
     * @param string   
     * @param int|bool 
     * @param int|bool 
     * @param string   
     * @param string   
     * @param int      
     *
     * @return bool
     */
    public static function popBeforeSmtp(
        $host,
        $port = false,
        $timeout = false,
        $username = '',
        $password = '',
        $debug_level = 0
    ) {
        $pop = new self();

        return $pop->authorise($host, $port, $timeout, $username, $password, $debug_level);
    }

    /**
     
     * @param string   
     * @param int|bool 
     * @param int|bool 
     * @param string   
     * @param string   
     * @param int      
     *
     * @return bool
     */
    public function authorise($host, $port = false, $timeout = false, $username = '', $password = '', $debug_level = 0)
    {
        $this->host = $host;
        // If no port value provided, use default
        if (false === $port) {
            $this->port = static::DEFAULT_PORT;
        } else {
            $this->port = (int) $port;
        }
        // If no timeout value provided, use default
        if (false === $timeout) {
            $this->tval = static::DEFAULT_TIMEOUT;
        } else {
            $this->tval = (int) $timeout;
        }
        $this->do_debug = $debug_level;
        $this->username = $username;
        $this->password = $password;
        //  Reset the error log
        $this->errors = [];
        //  connect
        $result = $this->connect($this->host, $this->port, $this->tval);
        if ($result) {
            $login_result = $this->login($this->username, $this->password);
            if ($login_result) {
                $this->disconnect();

                return true;
            }
        }
        // We need to disconnect regardless of whether the login succeeded
        $this->disconnect();

        return false;
    }

    /**
     
     * @param string   
     * @param int|bool 
     * @param int      
     *
     * @return bool
     */
    public function connect($host, $port = false, $tval = 30)
    {
        //  Are we already connected?
        if ($this->connected) {
            return true;
        }

        
        set_error_handler([$this, 'catchWarning']);

        if (false === $port) {
            $port = static::DEFAULT_PORT;
        }

        //  connect to the POP3 server
        $errno = 0;
        $errstr = '';
        $this->pop_conn = fsockopen(
            $host, 
            $port, 
            $errno, 
            $errstr, 
            $tval
        ); 
        restore_error_handler();

        //  Did we connect?
        if (false === $this->pop_conn) {
            //  It would appear not...
            $this->setError(
                "Failed to connect to server $host on port $port. errno: $errno; errstr: $errstr"
            );

            return false;
        }

        //  Increase the stream time-out
        stream_set_timeout($this->pop_conn, $tval, 0);

        //  Get the POP3 server response
        $pop3_response = $this->getResponse();
        //  Check for the +OK
        if ($this->checkResponse($pop3_response)) {
            
            $this->connected = true;

            return true;
        }

        return false;
    }

    /**
     
     * @param string 
     * @param string 
     *
     * @return bool
     */
    public function login($username = '', $password = '')
    {
        if (!$this->connected) {
            $this->setError('Not connected to POP3 server');
        }
        if (empty($username)) {
            $username = $this->username;
        }
        if (empty($password)) {
            $password = $this->password;
        }

        // Send the Username
        $this->sendString("USER $username" . static::LE);
        $pop3_response = $this->getResponse();
        if ($this->checkResponse($pop3_response)) {
            // Send the Password
            $this->sendString("PASS $password" . static::LE);
            $pop3_response = $this->getResponse();
            if ($this->checkResponse($pop3_response)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Disconnect from the POP3 server.
     */
    public function disconnect()
    {
        $this->sendString('QUIT');
        
        try {
            @fclose($this->pop_conn);
        } catch (Exception $e) {
            //Do nothing
        }
    }

    /**
     
     * @param int 
     *
     * @return string
     */
    protected function getResponse($size = 128)
    {
        $response = fgets($this->pop_conn, $size);
        if ($this->do_debug >= 1) {
            echo 'Server -> Client: ', $response;
        }

        return $response;
    }

    /**
     
     * @param string $string
     *
     * @return int
     */
    protected function sendString($string)
    {
        if ($this->pop_conn) {
            if ($this->do_debug >= 2) { //Show client messages when debug >= 2
                echo 'Client -> Server: ', $string;
            }

            return fwrite($this->pop_conn, $string, strlen($string));
        }

        return 0;
    }

    /**
    
     *
     * @param string $string
     *
     * @return bool
     */
    protected function checkResponse($string)
    {
        if (strpos($string, '+OK') !== 0) {
            $this->setError("Server reported an error: $string");

            return false;
        }

        return true;
    }

    /**
     
     * @param string $error
     */
    protected function setError($error)
    {
        $this->errors[] = $error;
        if ($this->do_debug >= 1) {
            echo '<pre>';
            foreach ($this->errors as $e) {
                print_r($e);
            }
            echo '</pre>';
        }
    }

    /**
    
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * POP3 connection error handler.
     *
     * @param int    
     * @param string 
     * @param string 
     * @param int    
     */
    protected function catchWarning($errno, $errstr, $errfile, $errline)
    {
        $this->setError(
            'Connecting to the POP3 server raised a PHP warning:' .
            "errno: $errno errstr: $errstr; errfile: $errfile; errline: $errline"
        );
    }
}
