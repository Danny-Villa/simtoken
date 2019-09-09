# Simtoken

This package allows to create simple tokens by encoding plain text. For example if the plain text looks like this: "I'm me", after the encoding it will become like this: "5c6e54d5s5h89b9e".

## Installation

Use the package manager [composer](https://getcomposer.org/) to install Simtoken.

```bash
composer require dannyvilla/simtoken
```

## Usage

```php
require 'vendor/autoload.php';

$id = '100';
$encoded = SimToken::encode($id); // with salt and complexity 1
echo($encoded); // e8f8f8

$encoded = SimToken::encode($id, false, 2); // without salt and complexity 2
echo($encoded); // 188808880888

$encoded = SimToken::encode($id, true, 2); // with salt and complexity 2
echo($encoded); // b1h8b2h8b2h8

$encoded = SimToken::encode($id, false, 3); // without salt and complexity 3
echo($encoded); // 588888886888888868888888

$decoded = SimToken::decode($encoded, false, 3); // Decode the last encoded
echo($decoded); // 100
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)