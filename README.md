# Silverstripe mailable files module

The SilverStripe mailable files module allows you to create a form with checkboxes in which users can select which files they want to receive by email.

## Requirements

* SilverStripe ^4.0
* PHP >= 7.4, >= 8.0

## Installation

Install the module using composer by adding the module repository and a GitHub OAuth token with repo access to your `composer.json` file.

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/Violet88github/silverstripe-mailable-files"
        }
    ],
    "config": {
        "github-oauth": {
            "github.com": "1234567890abcdef1234567890abcdef12345678" // Github OAuth token with repo access
        }
    }
}
```

Then install the module using composer.

```bash
composer require violet88/silverstripe-mailable-files
```

## Configuration

The module includes 2 extensions that need to be added to the desired page class and the corresponding page controller class.

```yaml
---
name: extensions
---
Page:
    extensions:
        - Violet88\MailableFilesModule\DataExtensions\MailableFilesPageExtension

PageController:
    extensions:
        - Violet88\MailableFilesModule\DataExtensions\MailableFilesPageControllerExtension
```

## Usage

After adding the extensions to the page and page controller classes, a new tab will be added to the page CMS interface. In this tab you can add files that can be selected by the user in the form.

The form can be added to the page template using the following code.

```html
<body>
...
$MailableFilesForm
...
</body>
```
