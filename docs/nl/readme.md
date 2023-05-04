# Silverstripe mailable files module

De SilverStripe mailable files module maakt het mogelijk om een formulier met checkboxes te maken waarin gebruikers kunnen aangeven welke bestanden ze per e-mail willen ontvangen.

## Requirements

* SilverStripe ^4.0
* PHP >= 7.4, >= 8.0

## Installatie

Installeer de module met behulp van composer door het module repository en een GitHub OAuth token met repo toegang toe te voegen aan je `composer.json` bestand.

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

Installeer vervolgens de module met behulp van composer.

```bash
composer require violet88/silverstripe-mailable-files
```

## Configuration

De module bevat 2 extensions die moeten worden toegevoegd aan de gewenste page class en de bijbehorende page controller class.

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

Nadat de extensions zijn toegevoegd aan de page en page controller classes, wordt er een nieuw tabblad toegevoegd aan de page CMS interface. In dit tabblad kunnen bestanden worden toegevoegd die door de gebruiker kunnen worden geselecteerd in het formulier.

Het formulier kan aan de page template worden toegevoegd met behulp van de volgende code.

```html
<body>
...
$MailableFilesForm
...
</body>
```
