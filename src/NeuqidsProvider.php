<?php
namespace Wuwx\LaravelSocialiteNeuqids;

use Closure;
use Laravel\Socialite\Contracts\Provider as ProviderContract;
use phpCAS;

class NeuqidsProvider implements ProviderContract
{
    public function __construct()
    {
        phpCAS::client(CAS_VERSION_2_0, "ids.neuq.edu.cn", 443, "authserver");
        Closure::bind(static function() {
            return self::$_PHPCAS_CLIENT->setBaseURL("http://ids.neuq.edu.cn/authserver/");
        }, null, phpCAS::class)();
        phpCAS::setNoCasServerValidation();
    }

    public function redirectUrl($url)
    {
        phpCAS::setFixedServiceURL($url);
        return $this;
    }

    public function redirect()
    {
        return redirect(phpCAS::getServerLoginURL());
    }

    public function user()
    {
        phpCAS::forceAuthentication();
        return (new User)->map([
            'id' => phpCAS::getUser(),
            'name' => phpCAS::getAttribute('cn'),
        ]);
    }
}
