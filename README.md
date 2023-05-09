[![Latest Stable Version](https://poser.pugx.org/laravel_crm/capsulecrm/v)](//packagist.org/packages/laravel_crm/capsulecrm) [![Total Downloads](https://poser.pugx.org/laravel_crm/capsulecrm/downloads)](//packagist.org/packages/laravel_crm/capsulecrm) [![Latest Unstable Version](https://poser.pugx.org/laravel_crm/capsulecrm/v/unstable)](//packagist.org/packages/laravel_crm/capsulecrm) [![License](https://poser.pugx.org/laravel_crm/capsulecrm/license)](//packagist.org/packages/laravel_crm/capsulecrm)

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
   'providers' => [
         CapsuleCRM\CapsuleServiceProvider::class,
   ];
   ``` 
   * And add alias in ```config/app.php``` in ```aliases``` array add 
   ```php
   'aliases' => [
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
Common usage :
```php
CapsuleCRM::{entity name}()
````
Example :
```php 
CapsuleCRM::party()
```
   * Party:
   Parties represent the People and Organisations on your Capsule account.
   His Object is :
   ```php
   CapsuleCRM::party();
   ```
   for crud operations :
   
   1. Create new account :
   ```php 
   $data = [
   'name' => 'youssef daood',
   'email' => 'ydaood@arkdev.net',
   'tags' => ['register','subscribe']
   ];
   CapsuleCRM::party()->create($data);
   ```
   
   2. Resgister account:
  ```php
  $data = [
   'name' => 'youssef daood',
   'email' => 'ydaood@arkdev.net'
   ];
   $tag = 'subscribe';
  CapsuleCRM::party()->register($data, $tag);
  ```
  3. Update account:
  ```php
  $id = 1; // id of capsule
  $data = [
  'name' => 'youssef'
  ];
  CapsuleCRM::party()->update($id, $data);
  ```
  4. validateUniqueEmail:
  ```php  
  $email = 'ydaood@arkdev.net';
  CapsuleCRM::party()->validateUniqueEmail($email);
  ``` 
  5. Search
  ```php  
  $filter = 'youssef';
  CapsuleCRM::party()->search($filter);
  ``` 
  6. Fetch one party
  ```php  
  $party_id=123456;
  $party = CapsuleCRM::party()->fetch($party_id);
  ``` 
  7. Get all person objects for a party
  ```php  
  $party_id=123456;
  $people = CapsuleCRM::party()->people($party_id);
  ``` 
   

