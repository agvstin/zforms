<?php
require_once __DIR__ .'/bootstrap.php';

$form->setMethod(
    'get'
)->addElement('text', 'firstName', array(
    'label' => 'First name',
    'required' => true,
))->addElement('text', 'lastName', array(
    'label' => 'Last name',
    'required' => true,
))->addInlineGroup(
    array('firstName', 'lastName'), 'fullname', array('legend' => 'Name')
);

$subForm = new zforms\SubForm(array(
    'legend' => 'Billing Address'
));
$subForm->addElement('text', 'street', array(
    'label' => 'Street Address 1',
    'required' => true,
))->addElement('text', 'street2', array(
    'label' => 'Street Address 2',
    'required' => true,
));
$form->addSubForm($subForm, 'billingAddress');

$form->addElement('button', 'cancel', array(
    'label' => 'Cancel',
    'ignore' => true,
))->addElement('submit', 'submit', array(
    'label' => 'Submit',
    'ignore' => true,
))->addButtonGroup(array('cancel', 'submit'), 'buttons');

if (isset($_GET['submit'])) {
    $form->isValid($_GET);
}
echo $view->render('layout.php');

