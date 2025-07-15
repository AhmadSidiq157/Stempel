<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Base Site URL
     * --------------------------------------------------------------------------
     */
    public string $baseURL = 'http://stempel-app.test/';

    /**
     * --------------------------------------------------------------------------
     * Allowed Hostnames
     * --------------------------------------------------------------------------
     */
    public array $allowedHostnames = ['stempel-app.test'];

    /**
     * --------------------------------------------------------------------------
     * Index File
     * --------------------------------------------------------------------------
     */
    public string $indexPage = '';

    /**
     * --------------------------------------------------------------------------
     * URI PROTOCOL
     * --------------------------------------------------------------------------
     */
    public string $uriProtocol = 'REQUEST_URI';

    /**
     * --------------------------------------------------------------------------
     * Default Locale
     * --------------------------------------------------------------------------
     */
    public string $defaultLocale = 'id';

    /**
     * --------------------------------------------------------------------------
     * Negotiate Locale
     * --------------------------------------------------------------------------
     */
    public bool $negotiateLocale = false;

    /**
     * --------------------------------------------------------------------------
     * Supported Locales
     * --------------------------------------------------------------------------
     */
    public array $supportedLocales = ['en', 'id'];

    /**
     * --------------------------------------------------------------------------
     * Application Timezone
     * --------------------------------------------------------------------------
     *
     * The default timezone that will be used in your application to display
     * dates with the date helper, and can be retrieved through app_timezone()
     *
     * @var string
     */
    // INI ADALAH BARIS PERBAIKANNYA
    public string $appTimezone = 'Asia/Jakarta';

    /**
     * --------------------------------------------------------------------------
     * Default Character Set
     * --------------------------------------------------------------------------
     */
    public string $charset = 'UTF-8';

    /**
     * --------------------------------------------------------------------------
     * Force Global Secure Requests
     * --------------------------------------------------------------------------
     */
    public bool $forceGlobalSecureRequests = false;

    /**
     * --------------------------------------------------------------------------
     * Session Variables
     * --------------------------------------------------------------------------
     */
    public string $sessionDriver            = 'CodeIgniter\Session\Handlers\FileHandler';
    public string $sessionCookieName        = 'ci_session';
    public int $sessionExpiration           = 7200;
    public ?string $sessionSavePath         = WRITEPATH . 'session';
    public bool $sessionMatchIP             = false;
    public int $sessionTimeToUpdate         = 300;
    public bool $sessionRegenerateDestroy   = false;

    /**
     * --------------------------------------------------------------------------
     * Cookie Related Variables
     * --------------------------------------------------------------------------
     */
    public string $cookiePrefix   = '';
    public string $cookieDomain   = '';
    public string $cookiePath     = '/';
    public bool $cookieSecure     = false;
    public bool $cookieHTTPOnly   = false;
    public string $cookieSameSite = 'Lax';

    /**
     * --------------------------------------------------------------------------
     * Reverse Proxy IPs
     * --------------------------------------------------------------------------
     */
    public array $proxyIPs = [];

    /**
     * --------------------------------------------------------------------------
     * Cross-Site Request Forgery
     * --------------------------------------------------------------------------
     */
    public bool $CSRFProtection = true;
    public string $CSRFTokenName = 'csrf_test_name';
    public string $CSRFHeaderName = 'X-CSRF-TOKEN';
    public int $CSRFExpire = 7200;
    public string $CSRFRegenerate = 'true';
    public bool $CSRFRedirect = false;
    public string $CSRFSameSite = 'Lax';

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy
     * --------------------------------------------------------------------------
     */
    public bool $CSPEnabled = false;
}
