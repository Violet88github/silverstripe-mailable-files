<?php

namespace Violet88\MailableFilesModule\DataObjects;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

class MailableFile extends DataObject
{
    private static $table_name = 'Violet88_MailableFilesModule_MailableFile';

    private static $db = [
        'Name' => 'Varchar(255)',
        'Description' => 'Text',
    ];

    private static $has_one = [
        'File' => File::class,
    ];

    private static $owns = [
        'File',
    ];

    private static $summary_fields = [
        'Name' => 'Name',
        'Description' => 'Description',
        'File.Name' => 'File Name',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'FileID',
            'SortOrder',
        ]);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Name', 'Name'),
            TextareaField::create('Description', 'Description'),
            UploadField::create('File', 'File')
                ->setFolderName('MailableFiles')
                ->setAllowedFileCategories('document')
                ->setAllowedMaxFileNumber(1),
        ]);

        return $fields;
    }

    public function onAfterWrite()
    {
        parent::onAfterWrite();

        if ($this->File()->exists())
            $this->File()->doPublish();
    }
}
