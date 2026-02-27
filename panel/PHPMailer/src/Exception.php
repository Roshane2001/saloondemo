<?php
/**
 * PHPMailer Exception class.
 * PHP Version 5.5.
 *
 * @see       
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
 * PHPMailer exception handler.
 *
 * @author Marcus Bointon <phpmailer@synchromedia.co.uk>
 */
class Exception extends \Exception
{
    /**
     * Prettify error message output.
     *
     * @return string
     */
    public function errorMessage()
    {
        return '<strong>' . htmlspecialchars($this->getMessage()) . "</strong><br />\n";
    }
}
