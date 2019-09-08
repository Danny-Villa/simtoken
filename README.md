# Simtoken

This package allows to create simple tokens by encoding plain text. For example if the plain text looks like this: "I'm me", after the encoding it will become like this: "5c6e54d5s5h89b9e".

## Installation

Use the package manager [composer](https://getcomposer.org/) to install Simtoken.

```bash
composer require dannyvilla/simtoken
```

## Usage

```php
$encoded = SimToken::encode('foo') 
$encodedWithoutSalt = SimToken::encode('foo', false)
$encodedWithComplexity3 = SimToken::encode('foo', true, 3)
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)
