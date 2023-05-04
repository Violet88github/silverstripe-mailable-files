<?php

namespace Violet88\MailableFilesModule\DataExtensions;

use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\ORM\DataExtension;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;
use Violet88\MailableFilesModule\DataObjects\MailableFile;

class MailableFilesPageExtension extends DataExtension
{
    private static $many_many = [
        'MailableFiles' => MailableFile::class
    ];

    private static $owns = [
        'MailableFiles'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab('Root.MailableFiles', GridField::create(
            'MailableFiles',
            'Mailable Files',
            $this->owner->MailableFiles(),
            GridFieldConfig_RecordEditor::create()
        ));
    }
}
