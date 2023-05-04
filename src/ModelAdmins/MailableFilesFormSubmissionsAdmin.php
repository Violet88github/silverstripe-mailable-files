<?php

namespace Violet88\MailableFilesModule\ModelAdmins;

use SilverStripe\Admin\ModelAdmin;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use Violet88\MailableFilesModule\DataObjects\MailableFilesFormSubmission;

class MailableFilesFormSubmissionsAdmin extends ModelAdmin
{
    private static $menu_title = 'Mailable Files Form Submissions';
    private static $url_segment = 'mailable-files-form-submissions';
    private static $managed_models = [
        MailableFilesFormSubmission::class,
    ];
    private static $menu_icon_class = 'font-icon-p-mail';

    public function updateGridField(GridField $grid)
    {
        $grid->getConfig()->removeComponentsByType(GridFieldAddNewButton::class);
    }
}
