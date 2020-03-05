<?php
namespace Wuwx\LaravelSocialiteNeuqids;

class NeuqidsProvider {

    public function __construct()
    {
        phpCAS::client(CAS_VERSION_2_0, "ids.neuq.edu.cn", 443, "authserver");
        phpCAS::setNoCasServerValidation();
    }

    public function redirect()
    {
        phpCAS::setFixedServiceURL(phpCAS::getServiceURL() . "/callback");
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