<?php

namespace Violet88\MailableFilesModule\DataObjects;

use SilverStripe\ORM\DataObject;

class MailableFilesFormSubmission extends DataObject
{
    private static $table_name = 'Violet88_MailableFilesModule_MailableFilesFormSubmission';

    private static $db = [
        'Email' => 'Varchar(255)',
        'MailableFilesIds' => 'Text',
    ];

    private static $summary_fields = [
        'Email' => 'Email Address',
        'MailableFiles' => 'Files',
    ];

    public function MailableFiles()
    {
        $ids = explode(',', $this->MailableFilesIds ?? '');
        return implode("\n", MailableFile::get()->filter('ID', $ids)->column('Name'));
    }
}
