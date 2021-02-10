<?php
/*!
* Arifauth
* https://Arifauth.github.io | https://github.com/Arifauth/Arifauth
*  (c) 2020 Arifauth authors | https://Arifauth.github.io/license.html
*/

namespace Arifauth\Provider;

use Arifauth\Adapter\OAuth2;
use Arifauth\Exception\UnexpectedApiResponseException;
use Arifauth\Data;
use Arifauth\User;

/**
 * Dropbox OAuth2 provider adapter.
 */
class Dropbox extends OAuth2
{
    /**
     * {@inheritdoc}
     */
    protected $scope = 'account_info.read';

    /**
     * {@inheritdoc}
     */
    protected $apiBaseUrl = 'https://api.dropbox.com/2/';

    /**
     * {@inheritdoc}
     */
    protected $authorizeUrl = 'https://www.dropbox.com/1/oauth2/authorize';

    /**
     * {@inheritdoc}
     */
    protected $accessTokenUrl = 'https://api.dropbox.com/1/oauth2/token';

    /**
     * {@inheritdoc}
     */
    protected $apiDocumentation = 'https://www.dropbox.com/developers/documentation/http/documentation';

    /**
     * {@inheritdoc}
     */
    public function getUserProfile()
    {
        $response = $this->apiRequest('users/get_current_account', 'POST', [], [], true);

        $data = new Data\Collection($response);

        if (!$data->exists('account_id') || !$data->get('account_id')) {
            throw new UnexpectedApiResponseException('Provider API returned an unexpected response.');
        }

        $userProfile = new User\Profile();

        $userProfile->identifier = $data->get('account_id');
        $userProfile->displayName = $data->filter('name')->get('display_name');
        $userProfile->firstName = $data->filter('name')->get('given_name');
        $userProfile->lastName = $data->filter('name')->get('surname');
        $userProfile->email = $data->get('email');
        $userProfile->photoURL = $data->get('profile_photo_url');
        $userProfile->language = $data->get('locale');
        $userProfile->country = $data->get('country');
        if ($data->get('email_verified')) {
            $userProfile->emailVerified = $data->get('email');
        }

        return $userProfile;
    }
}
