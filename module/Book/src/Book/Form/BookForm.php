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
            'attributes'=> array(
                'type' => 'Text',
                'id'   => 'user_name',
            ),
            'options' => array(
                'label' => 'User Name',
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'attributes'=> array(
                'type' => 'email',
                'id'   => 'email',
            ),
            'options' => array(
                'label' => 'Email',
            ),
        ));
        $this->add(array(
            'name' => 'home_page',
            'attributes'=> array(
                'type' => 'url',
                'id'   => 'home_page',
            ),
            'options' => array(
                'label' => 'Home page',
            ),
        ));
        $this->add(array(
            'name' => 'message',
            'attributes'=> array(
                'type' => 'Text',
                'id'   => 'message',
            ),
            'options' => array(
                'label' => 'Text',
            ),
        ));
        $this->add(array(
            'name' => 'button',
            'type' => 'button',
            'attributes' => array(
                'value' => 'Add',
                'id' => 'button',
            ),
        ));
        $this->add(array(
            'name' => 'user_ip',
            'type' => 'Hidden',
        ));
    }
    public function getInvalidInputName(){
        $names=$this->getInputFilter()->getInvalidInput();
        foreach ($names as $n=>$k){
            $val=$k->value;
            $name[$n]= $val;
        }
        return $name;
    }
}