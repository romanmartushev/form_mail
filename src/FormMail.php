<?php

namespace Pbc\FormMail;

use Illuminate\Database\Eloquent\Model;
use utilphp\util;

/**
 * Class FormMail
 * @package Pbc\FormMail
 */
class FormMail extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'form',
        'resource',
        'sender',
        'recipient',
        'fields',
        'message_to_recipient',
        'message_to_sender',
        'subject',
        'branding',
        'head',
        'message_sent_to_recipient',
        'confirmation_sent_to_sender',
        'confirmation',
        'queue',
    ];
    
    /**
     * @var string
     */
    protected $table = 'form_mail';

    /**
     * store the fields value as a json array
     *
     * @param $value
     */
    public function setFieldsAttribute($value)
    {
        $this->attributes['fields'] = json_encode($value);
    }

    /**
     * return the fields list as an array
     *
     * @return array
     */
    public function getFieldsAttribute()
    {
        return json_decode($this->attributes['fields'], true);
    }

    /**
     * @param $value
     * @return string
     */
    public function setMessageToRecipientAttribute($value)
    {
        if (is_string($value)) {
            $value = ['html' => $value];
        }
        $this->attributes['message_to_recipient'] = json_encode($value);
    }

    /**
     * @return array
     */
    public function getMessageToRecipientAttribute()
    {
        return json_decode($this->attributes['message_to_recipient'], true);
    }
    /**
     * @param $value
     * @return string
     */
    public function setMessageToSenderAttribute($value)
    {
        if (is_string($value)) {
            $value = ['html' => $value];
        }
        $this->attributes['message_to_sender'] = json_encode($value);
    }

    /**
     * @return array
     */
    public function getMessageToSenderAttribute()
    {
        return json_decode($this->attributes['message_to_sender'], true);
    }

    /**
     * return column list
     *
     * @return array
     */
    public function columns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    /**
     * @param $value
     */
    public function setHeadAttribute($value)
    {
        if(is_array($value)) {
            $this->attributes['head'] = json_encode($value);
        } else {
            $this->attributes['head'] = $value;
        }
    }

    /**
     * @return mixed
     */
    public function getHeadAttribute()
    {
        $decode = @json_decode($this->attributes['head'], true);
        if($decode) {
            return $decode;
        } else {
            return $this->attributes['head'];
        }
    }

    /**
     * @param $value
     */
    public function setSubjectAttribute($value)
    {
        if(is_array($value)) {
            $this->attributes['subject'] = json_encode($value);
        } else {
            $this->attributes['subject'] = $value;
        }
    }

    /**
     * @return mixed
     */
    public function getSubjectAttribute()
    {
        $decode = @json_decode($this->attributes['subject'], true);
        if($decode) {
            return $decode;
        } else {
            return $this->attributes['subject'];
        }
    }

    /**
     * @param $data
     */
    public function setConfirmationAttribute($data)
    {
        $this->attributes['confirmation'] = util::str_to_bool($data);
    }

    /**
     * @param $data
     */
    public function setQueueAttribute($data)
    {
        $this->attributes['queue'] = util::str_to_bool($data);
    }
}
