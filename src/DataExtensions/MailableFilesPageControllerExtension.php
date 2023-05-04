<?php

namespace Violet88\MailableFilesModule\DataExtensions;

use SilverStripe\Control\Email\Email;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;

class MailableFilesPageControllerExtension extends DataExtension
{
    private static $allowed_actions = [
        'MailableFilesForm',
    ];

    public function MailableFilesForm(): Form
    {
        $page = $this->owner->data();
        $fields = FieldList::create();
        $actions = FieldList::create();
        $required = new RequiredFields('Email', 'MailableFiles');

        // If there are no mailable files, don't show the form
        if (!$page->MailableFiles()->exists())
            return Form::create($this->owner, 'doProcessMailables', $fields, $actions);

        $fields->push(
            EmailField::create('Email', _t(__CLASS__, 'Email'))
                ->setAttribute('placeholder', _t(__CLASS__, 'EmailPlaceholder'))
                ->setAttribute('required', 'required')
                ->setAttribute('type', 'email')
        );

        $fields->push(
            CheckboxSetField::create(
                'MailableFiles',
                _t(__CLASS__, 'MailableFiles'),
                $page->MailableFiles()->map('ID', 'Name')
            )
                ->setAttribute('required', 'required')
        );

        $actions->push(FormAction::create('doProcessMailables', _t(__CLASS__, 'Request')));

        return Form::create($this->owner, 'MailableFilesForm', $fields, $actions, $required);
    }

    public function doProcessMailables($data, Form $form)
    {
        $page = $this->owner->data();
        $files = $page->MailableFiles()->filter('ID', $data['MailableFiles']);
        $email = $data['Email'];

        $email = Email::create()
            ->setFrom('no-reply@' . $_SERVER['HTTP_HOST'])
            ->setTo($email)
            ->setSubject(_t(__CLASS__, 'EmailSubject'))
            ->setData([
                'Files' => array_column($files->toArray(), 'Name'),
                'Email' => $email,
            ]);

        foreach ($files as $file)
            $email->addAttachmentFromData($file->File->getString(), $file->File->Name, $file->File->getMimeType());

        if ($email->send())
            $form->sessionMessage(_t(__CLASS__, 'RequestSent'), 'success');
        else
            $form->sessionMessage(_t(__CLASS__, 'RequestFailed'), 'danger');

        return $this->owner->redirectBack();
    }
}
