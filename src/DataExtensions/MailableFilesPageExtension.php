<?php

namespace Violet88\MailableFilesModule\DataExtensions;

use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\ValidationResult;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;
use Violet88\MailableFilesModule\DataObjects\MailableFile;

class MailableFilesPageExtension extends DataExtension
{
    private static $db = [
        'MailFrom' => 'Varchar(255)',
    ];

    private static $many_many = [
        'MailableFiles' => MailableFile::class
    ];

    private static $owns = [
        'MailableFiles'
    ];

    private static $defaults = [
        'MailFrom' => 'no-reply@example.com'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab('Root.MailableFiles', [
            EmailField::create('MailFrom', 'Mail from address')
                ->setDescription('This is the email address that will be used as the "from" address when sending emails.'),
            GridField::create(
                'MailableFiles',
                'Mailable Files',
                $this->owner->MailableFiles(),
                GridFieldConfig_RecordEditor::create()
            )
        ]);
    }

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();

        if (!$this->owner->MailFrom) {
            $this->owner->MailFrom = 'no-reply@' . $_SERVER['HTTP_HOST'];
        }
    }
}
