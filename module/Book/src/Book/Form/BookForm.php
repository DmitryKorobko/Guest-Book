<?php
/**
 * Created by PhpStorm.
 * User: steinmann
 * Date: 09.09.16
 * Time: 17:01
 */

namespace Book\Form;

use Zend\Form\Form;

class BookForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('book');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'user_name',
            'type' => 'Text',
            'options' => array(
                'label' => 'User name',
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'type' => 'email',
            'options' => array(
                'label' => 'E-mail',
            ),
        ));
        $this->add(array(
            'name' => 'home_page',
            'type' => 'url',
            'options' => array(
                'label' => 'Home page',
            ),
        ));
        $this->add(array(
            'name' => 'message',
            'type' => 'Text',
            'options' => array(
                'label' => 'Message',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));

        $this->add(array(
            'name' => 'user_ip',
            'type' => 'Hidden',
        ));
    }
}