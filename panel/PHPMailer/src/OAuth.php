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
 * 
 */

namespace PHPMailer\PHPMailer;

use League\OAuth2\Client\Grant\RefreshToken;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;

/**
 
 * @see     
 * @author  
 */
class OAuth
{
    /**
     
     * @var AbstractProvider
     */
    protected $provider;

    /**
     * The current OAuth access token.
     *
     * @var AccessToken
     */
    protected $oauthToken;

    /**
     
     * @var string
     */
    protected $oauthUserEmail = '';

    /**
     
     * @var string
     */
    protected $oauthClientSecret = '';

    /**
     
     * @var string
     */
    protected $oauthClientId = '';

    /**
     * The refresh token, used to obtain new AccessTokens.
     *
     * @var string
     */
    protected $oauthRefreshToken = '';

    /**
     * OAuth constructor.
     *
     * @param array 
     *                       
     */
    public function __construct($options)
    {
        $this->provider = $options['provider'];
        $this->oauthUserEmail = $options['userName'];
        $this->oauthClientSecret = $options['clientSecret'];
        $this->oauthClientId = $options['clientId'];
        $this->oauthRefreshToken = $options['refreshToken'];
    }

    /**
     * Get a new RefreshToken.
     *
     * @return RefreshToken
     */
    protected function getGrant()
    {
        return new RefreshToken();
    }

    /**
     * Get a new AccessToken.
     *
     * @return AccessToken
     */
    protected function getToken()
    {
        return $this->provider->getAccessToken(
            $this->getGrant(),
            ['refresh_token' => $this->oauthRefreshToken]
        );
    }

    /**
     * Generate a base64-encoded OAuth token.
     *
     * @return string
     */
    public function getOauth64()
    {
        // Get a new token if it's not available or has expired
        if (null === $this->oauthToken || $this->oauthToken->hasExpired()) {
            $this->oauthToken = $this->getToken();
        }

        return base64_encode(
            'user=' .
            $this->oauthUserEmail .
            "\001auth=Bearer " .
            $this->oauthToken .
            "\001\001"
        );
    }
}
