<?php

namespace zforms;

class SubForm extends Form
{
    /**
     * Whether or not form elements are members of an array
     * @var bool
     */
    protected $_isArray = true;

    /**
     * Load the default decorators
     *
     * @return Zend_Form_SubForm
     */ 
    public function loadDefaultDecorators()
    { 
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;      
        } 

        $decorators = $this->getDecorators();
        if (empty($decorators)) {       
          $this->addDecorator('Description')
                 ->addDecorator('FormElements')  
                 ->addDecorator('Fieldset')  
                 ->addDecorator('HtmlTag', array('tag' => 'div', 'class' => 'zforms-component'));
        }
        return $this;
    }
} 

