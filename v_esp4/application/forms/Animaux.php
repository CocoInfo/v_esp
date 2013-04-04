<?php

class Application_Form_Animaux extends Zend_Form {

    public function init()
    {
        $this->setName('animal');

        $idAnimal = new Zend_Form_Element_Hidden('idAnimal');
        $idAnimal->addFilter('Int');

        $prenomAnimal = new Zend_Dojo_Form_Element_TextBox('prenomAnimal');
        $prenomAnimal->setLabel('Prenom')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');

        $dateNaissanceAnimal = new Zend_Dojo_Form_Element_DateTextBox('dateNaissanceAnimal');
        $dateNaissanceAnimal->setLabel('Date de naissance')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $type = new Zend_Dojo_Form_Element_TextBox('type');
        $type->setLabel('Type')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $Personne_idPersonne = new Zend_Dojo_Form_Element_NumberTextBox('Personne_idPersonne');
        $Personne_idPersonne->setLabel('Personne_idPersonne')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');

        $envoyer = new Zend_Dojo_Form_Element_Button('envoyer', array('type' => 'submit'));
        $envoyer->setAttrib('idAnimal', 'boutonenvoyer');

        $this->addElements(array($idAnimal, $prenomAnimal, $dateNaissanceAnimal, $type, $Personne_idPersonne, $envoyer));
    }

}