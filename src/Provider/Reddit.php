<?php
/*!
* Arifauth
* https://Arifauth.github.io | https://github.com/Arifauth/Arifauth
*  (c) 2017 Arifauth authors | https://Arifauth.github.io/license.html
*/

namespace Arifauth\Provider;

use Arifauth\Adapter\OAuth2;
use Arifauth\Exception\UnexpectedApiResponseException;
use Arifauth\Data;
use Arifauth\User;

/**
 * Reddit OAuth2 provider adapter.
 */
class Reddit extends OAuth2
{
    /**
     * {@inheritdoc}
     */
    protected $scope = 'identity';

    /**
     * {@inheritdoc}
     */
    protected $apiBaseUrl = 'https://oauth.reddit.com/api/v1/';

    /**
     * {@inheritdoc}
     */
    protected $authorizeUrl = 'https://ssl.reddit.com/api/v1/authorize';

    /**
     * {@inheritdoc}
     */
    protected $accessTokenUrl = 'https://ssl.reddit.com/api/v1/access_token';

    /**
     * {@inheritdoc}
     */
    protected $apiDocumentation = 'https://github.com/reddit/reddit/wiki/OAuth2';

    /**
     * {@inheritdoc}
     */
    protected function initialize()
    {
        parent::initialize();

        $this->AuthorizeUrlParameters += [
            'duration' => 'permanent'
        ];

        $this->tokenExchangeParameters = [
            'client_id' => $this->clientId,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->callback
        ];

        $this->tokenExchangeHeaders = [
            'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret)
        ];

        $this->tokenRefreshHeaders = $this->tokenExchangeHeaders;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserProfile()
    {
        $response = $this->apiRequest('me.json');

        $data = new Data\Collection($response);

        if (!$data->exists('id')) {
            throw new UnexpectedApiResponseException('Provider API returned an unexpected response.');
        }

        $userProfile = new User\Profile();

        $userProfile->identifier = $data->get('id');
        $userProfile->displayName = $data->get('name');
        $userProfile->profileURL = 'https://www.reddit.com/user/' . $data->get('name') . '/';
        $userProfile->photoURL = $data->get('icon_img');

        return $userProfile;
    }
}
