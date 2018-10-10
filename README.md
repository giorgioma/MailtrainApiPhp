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

echo $client->getLists();
echo "\n\n\n-------------------------------\n\n\n";
echo $client->getList($listID);
echo "\n\n\n-------------------------------\n\n\n";
echo $client->getSubscriptions($listCode);
echo "\n\n\n-------------------------------\n\n\n";
echo $client->getBlacklist();
echo "\n\n\n-------------------------------\n\n\n";
echo $client->subscribe($listCode,[
			'EMAIL'=>$subscribeEmail,
			'FIRST_NAME'=>$subscribeFirstName,
			'LAST_NAME'=>$subscribeLastName,
			'REQUIRE_CONFIRMATION' => 'yes'
]);
echo "\n\n\n-------------------------------\n\n\n";
echo $client->getLists($subscribeEmail);
echo "\n\n\n-------------------------------\n\n\n";

//This one will error, unless the User has clicked on the "REQUIRE_CONFIRMATION" link
echo $client->delete($listCode, $unsubscribe);
```

The only functions tested and working are the ones I am using in the example above, however all API entries described in the [Mailtrain documentation](https://github.com/Mailtrain-org/mailtrain/wiki/Using-API) are covered in the code and should work.

For more the details have a look in the code.

Any PR is welcome :)