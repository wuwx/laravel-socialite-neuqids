# laravel-socialite-neuqids

```composer require wuwx/laravel-socialite-neuqids```

```php
<?php
use Laravel\Socialite\Facades\Socialite;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return redirect()->route("login.neuqids");
    }
    public function redirectToProvider()
    {
        return Socialite::driver('neuqids')->redirect();
    }
    public function handleProviderCallback()
    {
        $user = Socialite::driver('neuqids')->user();
    }
}
```

```php
Route::get('login/neuqids', 'Auth\LoginController@redirectToProvider')->name("login.neuqids");
Route::get('login/neuqids/callback', 'Auth\LoginController@handleProviderCallback')->name("login.neuqids.callback");
```
