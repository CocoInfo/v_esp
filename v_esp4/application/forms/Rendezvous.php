<?php

class Application_Form_Rendezvous extends Zend_Form {

    public function init() {
        $this->setName('rendezvous');

        $date = new Zend_Dojo_Form_Element_DateTextBox('date');
        $date->setLabel('date')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $heure = new Zend_Dojo_Form_Element_TextBox('heure');
        $heure->setLabel('heure')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $Clinique_idClinique = new Zend_Dojo_Form_Element_TextBox('Clinique_idClinique');
        $Clinique_idClinique->setLabel('id Clinique')
                ->setRequired(true)
                ->addFilter('Int')
                ->addValidator('NotEmpty');

        $Animaux_idAnimal = new Zend_Dojo_Form_Element_DateTextBox('Animaux_idAnimal');
        $Animaux_idAnimal->setLabel('id Animal')
                ->setRequired(true)
                ->addFilter('Int')
                ->addValidator('NotEmpty');

        $Personne_idPersonne = new Zend_Dojo_Form_Element_TextBox('Personne_idPersonne');
        $Personne_idPersonne->setLabel('id Personne')
                ->setRequired(true)
                ->addFilter('Int')
                ->addValidator('NotEmpty');
        
        
        $envoyer = new Zend_Dojo_Form_Element_Button('envoyer', array('type' => 'submit'));
        $envoyer->setAttrib('id', 'boutonenvoyer');

        $this->addElements(array($date, $heure, $Clinique_idClinique, $Animaux_idAnimal, $Personne_idPersonne, $envoyer));
    }

}