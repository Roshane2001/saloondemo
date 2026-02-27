<?php
/**
 
 * @package 
 * @link 
 * @author 
 * @author 
 * @author 
 * @author 
 * @copyright 
 * @copyright 
 * @copyright 
 * @license 
 */

/**
 
 * @package 
 * @author 
 * @author 
 * @link 
 */
class PHPMailerOAuthGoogle
{
    private $oauthUserEmail = '';
    private $oauthRefreshToken = '';
    private $oauthClientId = '';
    private $oauthClientSecret = '';

    /**
     * @param string 
     * @param string 
     * @param string 
     * @param string 
     */
    public function __construct(
        $UserEmail,
        $ClientSecret,
        $ClientId,
        $RefreshToken
    ) {
        $this->oauthClientId = $ClientId;
        $this->oauthClientSecret = $ClientSecret;
        $this->oauthRefreshToken = $RefreshToken;
        $this->oauthUserEmail = $UserEmail;
    }

    private function getProvider()
    {
        return new League\OAuth2\Client\Provider\Google([
            'clientId' => $this->oauthClientId,
            'clientSecret' => $this->oauthClientSecret
        ]);
    }

    private function getGrant()
    {
        return new \League\OAuth2\Client\Grant\RefreshToken();
    }

    private function getToken()
    {
        $provider = $this->getProvider();
        $grant = $this->getGrant();
        return $provider->getAccessToken($grant, ['refresh_token' => $this->oauthRefreshToken]);
    }

    public function getOauth64()
    {
        $token = $this->getToken();
        return base64_encode("user=" . $this->oauthUserEmail . "\001auth=Bearer " . $token . "\001\001");
    }
}
