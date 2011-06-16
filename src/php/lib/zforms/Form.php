<?php

namespace zforms;

class Form extends \Zend_Form
{
    public function __construct($options = null)
    {
        $this->addElementPrefixPath('zforms\decorator', 'zforms\decorator', 'decorator');
        $this->addElementPrefixPath('zforms\filter', 'zforms\filter', 'filter');
        $this->addElementPrefixPath('zforms\validate', 'zforms\validate', 'validate');

        $getId = function($decorator) {
            return $decorator->getElement()->getId() ."-element";
        };
        $this->_elementDecorators = array(
            'ViewHelper',
            array('Description', array('tag' => 'span', 'class' => 'description')),
            'Errors',
            'Label',
            array('HtmlTag', array(
                'tag' => 'div',
                'id'  => array('callback' => $getId),
                'class' => 'zforms-element',
            )),
        );

        parent::__construct($options);
    }

    public function addInlineGroup(array $elements, $name, $options = array())
    {
        $options['decorators'] = array(
            'FormElements',
            'Fieldset',
            array('HtmlTag', array(
                'tag' => 'div',
                'id'  => 'zforms-component-' .$name,
                'class' => 'zforms-component zforms-inline-group',
            )),
        );

        foreach ($elements as $element) {
            $labelDecorator = $this->$element->getDecorator('Label');
            $labelDecorator->setOption('placement', 'APPEND');
            $currentLabelClass = $labelDecorator->getOption('class');
            $labelDecorator->setOption('class', $currentLabelClass .' zforms-sub-label');
        }
        $this->addDisplayGroup($elements, $name, $options);

        return $this;
    }

    public function addButtonGroup(array $elements, $name, $options = array())
    {
        $options['decorators'] = array(
            'FormElements',
            array('HtmlTag', array(
                'tag' => 'div',
                'id'  => 'zforms-component-' .$name,
                'class' => 'zforms-component zforms-button-group',
            )),
        );

        $this->addDisplayGroup($elements, $name, $options);

        return $this;
    }

    /**
     * Load the default decorators
     *
     * @override
     * @return void
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
                ->addDecorator('Form', array('class' => 'zforms'))
                ->addDecorator('HtmlTag', array('tag' => 'div', 'class' => 'zforms-wrapper'));
        }
        return $this;
    }

}
