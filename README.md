# unjudder/mail

Email Module for [Zendframework 2](http://framework.zend.com/ "Almost Genius").

   `#`          | `Uj\Mail`
----------------|----------
**Version**     | 1.0-alpha
**Authors**     | <ul><li>Alrik Zachert <alrik.zachert@unjudder.com></li></ul>
**License**     | [BSD-3-Clause](https://github.com/unjudder/zf2-mail/blob/master/LICENSE.md License)

## Overview

In most business applications you have to send many, different 
emails to your customers. On top of the zendframwork we provide
an easy to use, config aware email - service module.

## Features

- Provide configurable core services (transport, renderer, email)
- Render emails from templates
- Easy to use api

```php
$serviceLocator->get('Uj\Mail\Email')
	->send('module/nameOfEmailTpl', array(
		'to' => 'customer@domain.tld',
		'from' => 'service@your-service.tld',
		'subject' => 'What ever - Our Customer Services',
		// ... additional parameters to pass to view renderer
	));
```

## Installation

The easiest way to install unjudder/mail is by using [composer](http://getcomposer.org "composer - package manager").

- Add the following lines to your `composer.json`

```php
"require": {
	"unjudder/mail": "1.0-alpha"
}
```

- Load the zf2 module, edit your `config/application.config.php` file:

```php
'modules' => array(
	'Uj\Mail'
)
```

## Usage

### Configuration

The config is located in the nested config namespace 
```php
$config['uj']['mail'];
```
#### Uj\Mail\Transport

<table>
  <tr>
    <th>Key</th><th>Type</th><th>Description</th>
  </tr>
  <tr>
    <td>type</td>
	<td>string</td>
	<td>
		Transport class, lookup in \Zend\Mail\Transport\*.
		It must implement \Zend\Mail\Transport\TransportInterface.
	</td>
  </tr>
  <tr>
	<td>options</td>
	<td>array</td>
	<td>A list of options that will be passed to the transport options instance.</td>
  </tr>
</table>

## To do

- Improve the docs.
- Add controller plugin
- Add signature support
- Add (more) template storage adapters, eg. database
- Set Subject from within email template
- Add attachments/mime parts from within email template
- Add default email parameters (to, sender, ...)
- Message Queue/Cli Tool for sending many mails in background

## License

The files in this project are released under the unjudder license.
Please find a copy of this license bundled with this package in the file `LICENSE.md`.
Our License is also available through the web at: http://unjudder.com/license/new-bsd.
