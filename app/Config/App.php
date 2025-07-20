<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Base Site URL
     * --------------------------------------------------------------------------
     *
     * URL to your CodeIgniter root. Typically, this will be your base URL,
     * WITH a trailing slash:
     *
     * http://example.com/
     */
    public string $baseURL = 'http://stempel-app.test/';

    /**
     * --------------------------------------------------------------------------
     * Allowed Hostnames
     * --------------------------------------------------------------------------
     *
     * An array of hostname patterns that are allowed to access this application.
     * If not empty, only requests with a Host header matching one of the patterns
     * will be allowed.
     *
     * Example:
     * ['example.com', '*.example.com']
     */
    public array $allowedHostnames = [];

    /**
     * --------------------------------------------------------------------------
     * Index File
     * --------------------------------------------------------------------------
     *
     * Typically, this will be your index.php file, unless you've renamed it to
     * something else. If you are using mod_rewrite to remove the page set this
     * variable so that it is blank.
     */
    public string $indexPage = '';

    /**
     * --------------------------------------------------------------------------
     * URI PROTOCOL
     * --------------------------------------------------------------------------
     *
     * This item determines which server global should be used to retrieve the
     * URI string. The default setting of 'REQUEST_URI' works for most servers.
     * If your links do not seem to work, try one of the other delicious flavors:
     *
     * 'REQUEST_URI'    Uses $_SERVER['REQUEST_URI']
     * 'QUERY_STRING'   Uses $_SERVER['QUERY_STRING']
     * 'PATH_INFO'      Uses $_SERVER['PATH_INFO']
     *
     * @var string
     */
    public string $uriProtocol = 'REQUEST_URI';

    /**
     * --------------------------------------------------------------------------
     * Default Locale
     * --------------------------------------------------------------------------
     *
     * The Locale roughly represents the language and country that your app
     * is targeted towards. It affects the language strings and other
     * strings (like currency markers, numbers, etc), that your program
     * should run under for this request.
     */
    public string $defaultLocale = 'en';

    /**
     * --------------------------------------------------------------------------
     * Negotiate Locale
     * --------------------------------------------------------------------------
     *
     * If true, the current Request object will attempt to negotiate the best
     * locale for the client's needs based on the browser's language settings.
     */
    public bool $negotiateLocale = false;

    /**
     * --------------------------------------------------------------------------
     * Supported Locales
     * --------------------------------------------------------------------------
     *
     * An array of locales that are supported by the application. If a locale
     * is requested that is not listed here, the default locale will be used
     * instead.
     */
    public array $supportedLocales = ['en'];

    /**
     * --------------------------------------------------------------------------
     * Application Timezone
     * --------------------------------------------------------------------------
     *
     * The default timezone that will be used in your application to display
     * dates with the date helper, and can be retrieved through app_timezone()
     *
     */
    public string $appTimezone = 'Asia/Jakarta';

    /**
     * --------------------------------------------------------------------------
     * Default Character Set
     * --------------------------------------------------------------------------
     *
     * This determines which character set is used by default in various methods
     * that require a character set to be provided.
     *
     * @see http://php.net/manual/en/function.htmlspecialchars.php
     */
    public string $charset = 'UTF-8';

    /**
     * --------------------------------------------------------------------------
     * Force Global Secure Requests
     * --------------------------------------------------------------------------
     *
     * If true, this will force every request made to this application to be
     * secure, either via HTTPS or secure headers sent from a proxy.
     */
    public bool $forceGlobalSecureRequests = false;

    /**
     * --------------------------------------------------------------------------
     * Proxy IPs
     * --------------------------------------------------------------------------
     *
     * If your server is behind a reverse proxy, you must whitelist the proxy
     * IP addresses from which CodeIgniter should trust headers such as
     * X-Forwarded-For or Client-IP in order to properly identify the visitor's IP address.
     *
     * @var string[]
     */
    public array $proxyIPs = []; // <-- PERBAIKAN: Menambahkan baris yang hilang ini.

    /**
     * --------------------------------------------------------------------------
     * Session Variables
     * --------------------------------------------------------------------------
     */
    public string $sessionDriver            = 'CodeIgniter\Session\Handlers\FileHandler';
    public string $sessionCookieName        = 'ci_session';
    public int $sessionExpiration          = 7200;
    public string $sessionSavePath          = WRITEPATH . 'session';
    public bool $sessionMatchIP             = false;
    public int $sessionTimeToUpdate        = 300;
    public bool $sessionRegenerateDestroy = false;

    /**
     * --------------------------------------------------------------------------
     * Cookie Related Variables
     * --------------------------------------------------------------------------
     */
    public string $cookiePrefix   = '';
    public string $cookieDomain   = '';
    public string $cookiePath     = '/';
    public bool $cookieSecure   = false;
    public bool $cookieHTTPOnly = true;
    public string $cookieSameSite = 'Lax';

    /**
     * --------------------------------------------------------------------------
     * Cross-Site Request Forgery
     * --------------------------------------------------------------------------
     */
    public bool $CSRFProtection  = false;
    public bool $CSRFTokenRandomize = false;
    public string $CSRFTokenName   = 'csrf_test_name';
    public string $CSRFHeaderName  = 'X-CSRF-TOKEN';
    public string $CSRFCookieName  = 'csrf_cookie_name';
    public int $CSRFExpire      = 7200;
    public bool $CSRFRegenerate  = true;
    public bool $CSRFRedirect    = true;

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy
     * --------------------------------------------------------------------------
     */
    public bool $CSPEnabled = false;
}
