Mailtrain API PHP Library
=========================

This is a beta version

# Installation
```
composer require giorgioma/mailtrainapiphp
```

# Usage

```
<?php
require __DIR__ . '/vendor/autoload.php';
use GiorgioMa\MailtrainApiPhp\NewsletterApi;

$client = new NewsletterApi('http://newsletter.host.example', 'Your generated API key');

$listID = '1';
$listCode = 'XXXXXXX';
$subscribeEmail = 'hello@example.com';
$subscribeFirstName = "Name";
$subscribeLastName = "Surname";
$unsubscribe = 'hello@example.com';

$client->getLists();

$client->getList($listID);

$client->getSubscriptions($listCode);

$client->getBlacklist();

$client->subscribe($listCode,[
			'EMAIL'=>$subscribeEmail,
			'FIRST_NAME'=>$subscribeFirstName,
			'LAST_NAME'=>$subscribeLastName,
			'REQUIRE_CONFIRMATION' => 'yes'
]);

$client->getLists($subscribeEmail);


//This one will error, unless the User has clicked on the "REQUIRE_CONFIRMATION" link
$client->delete($listCode, $unsubscribe);
```

The only functions tested are the ones I am using in the examples above, however all API entries described in the [Mailtrain documentation](https://github.com/Mailtrain-org/mailtrain/wiki/Using-API) are covered in the code and should work.

# Return values
Each function performs a [Guzzle](http://docs.guzzlephp.org/en/stable/) request and returns the whole response object, so in your code you will have access to the full response
```
$res = $client->getList($listID);
echo $res->getStatusCode();
// "200"
echo $res->getHeader('content-type');
// 'application/json; charset=utf8'
echo $res->getBody();
```

For more the details have a look in the code.

Any PR is welcome :)