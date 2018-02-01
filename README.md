# laravelCapsuleCRM
### Agenda
  * [Intallation]()
  * [Configuration]()
  * [Working]()


### Installation 
   * Install from composer ````composer require laravel_crm/capsulecrm````
   * Add Service Provider in ```config/app.php```  add service provider class ```CapsuleCRM\CapsuleServiceProvider::class,``` in ```providers``` array 
   * And add alias in ```config/app.php``` in ```aliases``` array add ```'CapsuleCRM'=>CapsuleCRM\Facades\CapsuleCRM::class,```
   * Publish config file by ```php artisan vendor:publish --tag=capsuleCRM --force```
### Configuration
   * Add in ```.env``` file three keys of capsulecrm :
        * ```CAPSULECRM_TOKEN``` get it from capsule ```My Preferences``` -> ```API Authentication Tokens```->```Personal Access Tokens```
        * ```CAPSULECRM_APP_NAME```
        * ```CAPSULECRM_BASE_URI``` default is ```https://api.capsulecrm.com/api/v2/```
