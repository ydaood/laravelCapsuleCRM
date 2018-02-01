# laravelCapsuleCRM
### Agenda
  * [Intallation]()
  * [Configuration]()
  * [Usage]()
### Installation 
   * Install from composer 
   ````bash 
   composer require laravel_crm/capsulecrm
   ````
   * Add Service Provider in ```config/app.php```  add service provider class
   ```php 
   'providers'=>[
         CapsuleCRM\CapsuleServiceProvider::class,
   ];
   ``` 
   * And add alias in ```config/app.php``` in ```aliases``` array add 
   ```php
   'aliases'=>[
         'CapsuleCRM'=>CapsuleCRM\Facades\CapsuleCRM::class,
     ];
   ```
   * Publish config file by 
   ```bash
   php artisan vendor:publish --tag=capsuleCRM --force
   ```
### Configuration
   * Add in ```.env``` file three keys of capsulecrm :
        * ```CAPSULECRM_TOKEN``` get it from capsule ```My Preferences``` -> ```API Authentication Tokens```->```Personal Access Tokens```
        * ```CAPSULECRM_APP_NAME```
        * ```CAPSULECRM_BASE_URI``` default is ```https://api.capsulecrm.com/api/v2/```      
### Usage

