<?php
/*!
* Arifauth
* https://Arifauth.github.io | https://github.com/Arifauth/Arifauth
*  (c) 2017 Arifauth authors | https://Arifauth.github.io/license.html
*/

namespace Arifauth\Exception;

/**
 * Arifauth Exceptions Interface
 */
interface ExceptionInterface
{
    /*
    ExceptionInterface
    Exception                                             extends \Exception implements ExceptionInterface
    |   RuntimeException                                  extends Exception
    |   |    UnexpectedValueException                     extends RuntimeException
    |   |    |    AuthorizationDeniedException            extends UnexpectedValueException
    |   |    |    HttpClientFailureException              extends UnexpectedValueException
    |   |    |    HttpRequestFailedException              extends UnexpectedValueException
    |   |    |    InvalidAuthorizationCodeException       extends UnexpectedValueException
    |   |    |    InvalidAuthorizationStateException      extends UnexpectedValueException
    |   |    |    InvalidOauthTokenException              extends UnexpectedValueException
    |   |    |    InvalidAccessTokenException             extends UnexpectedValueException
    |   |    |    UnexpectedApiResponseException          extends UnexpectedValueException
    |   |
    |   |    BadMethodCallException                       extends RuntimeException
    |   |    |   NotImplementedException                  extends BadMethodCallException
    |   |
    |   |    InvalidArgumentException                     extends RuntimeException
    |   |    |   InvalidApplicationCredentialsException   extends InvalidArgumentException
    |   |    |   InvalidOpenidIdentifierException         extends InvalidArgumentException
*/
}
