<?php

class Application_Form_Clinique extends Zend_Form {

    public function init() {
        $this->setName('clinique');

        $idClinique = new Zend_Form_Element_Hidden('idClinique');
        $idClinique->addFilter('Int');

        $nomClinique = new Zend_Dojo_Form_Element_TextBox('nomClinique');
        $nomClinique->setLabel('Nom')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $proprietaireClinique = new Zend_Dojo_Form_Element_TextBox('proprietaireClinique');
        $proprietaireClinique->setLabel('Propriétaire')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $telClinique = new Zend_Dojo_Form_Element_TextBox('telClinique');
        $telClinique->setLabel('Téléphone')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $mailClinique = new Zend_Dojo_Form_Element_TextBox('mailClinique');
        $mailClinique->setLabel('Mail')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $Adresse_idAdresse = new Zend_Dojo_Form_Element_NumberTextBox('Adresse_idAdresse');
        $Adresse_idAdresse->setLabel('idAdresse')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');

        $envoyer = new Zend_Dojo_Form_Element_Button('envoyer', array('type' => 'submit'));
        $envoyer->setAttrib('idClinique', 'boutonenvoyer');

        $this->addElements(array($idClinique, $nomClinique, $proprietaireClinique, $telClinique, $mailClinique, $Adresse_idAdresse, $envoyer));
    }

}