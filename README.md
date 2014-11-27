#PHP Poppler

[![Build Status](https://secure.travis-ci.org/php-poppler/php-poppler.png?branch=master)](http://travis-ci.org/php-poppler/php-poppler)

PHP-Poppler is a tiny lib which help you to use Poppler tools http://poppler.freedesktop.org/

Poppler is GPL licensed and is described as "Poppler is a PDF rendering library based on the xpdf-3.0 code base."

Documentation available at http://php-poppler.readthedocs.org/

## Installation

It is recommended to install PHP-Poppler through
[Composer](http://getcomposer.org) :

```json
{
    "require": {
        "php-poppler/php-poppler": "~0.1.0"
    }
}
```

##Dependencies :

In order to use PHP-Poppler, you need to install Poppler. Depending of your
configuration, please follow the instructions at
http://poppler.freedesktop.org/.

##Main API usage :

```php
$file = new Poppler\Process\PdfFile(...);

// Get pdf info
print_r($file->getInfo('test.pdf'));

// Get text content of pdf
echo $file->toText('test.pdf');

// Transform to html
$file->toHtml('test.pdf', '/path/for/html');

##License

PHP-Poppler are released under MIT License http://opensource.org/licenses/MIT

See LICENSE file for more information
