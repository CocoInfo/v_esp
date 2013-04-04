<?php

class Application_Form_Personne extends Zend_Form {

    public function init() {
        $this->setName('personne');                              //adresse

        $idPersonne = new Zend_Form_Element_Hidden('idPersonne');
        $idPersonne->addFilter('Int');

        $nomPersonne = new Zend_Dojo_Form_Element_TextBox('nomPersonne');
        $nomPersonne->setLabel('Nom')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $prenomPersonne = new Zend_Dojo_Form_Element_TextBox('prenomPersonne');
        $prenomPersonne->setLabel('Prenom')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $dateNaissancePersonne = new Zend_Dojo_Form_Element_DateTextBox('dateNaissancePersonne');
        $dateNaissancePersonne->setLabel('Date de naissance')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $telFixePersonne = new Zend_Dojo_Form_Element_TextBox('telFixePersonne');
        $telFixePersonne->setLabel('Telephone fixe')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $telMobilePersonne = new Zend_Dojo_Form_Element_TextBox('telMobilePersonne');
        $telMobilePersonne->setLabel('Telephone mobile')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');

        $mailPersonne = new Zend_Dojo_Form_Element_TextBox('mailPersonne');
        $mailPersonne->setLabel('Mail')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $typePersonne = new Zend_Dojo_Form_Element_TextBox('typePersonne');
        $typePersonne->setLabel('Type')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $Adresse_idAdresse = new Zend_Dojo_Form_Element_NumberTextBox('Adresse_idAdresse');
        $Adresse_idAdresse->setLabel('idAdresse')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');


        /*$idcommune = new Zend_Dojo_Form_Element_FilteringSelect('commune_idcommune');
        $idcommune->setLabel('Commune')
                ->setAutoComplete(true)
                ->setStoreId('communeStore')
                ->setStoreType('dojo.data.ItemFileReadStore')
                ->setStoreParams(array('url' => '/v_esp/public/commune/communelist'))
                ->setAttrib("searchAttr", "label");*/

        $pwd = new Zend_Dojo_Form_Element_TextBox('pwd');
        $pwd->setLabel('Mot de passe')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');



        $envoyer = new Zend_Dojo_Form_Element_Button('envoyer', array('type' => 'submit'));
        $envoyer->setAttrib('idPersonne', 'boutonenvoyer');

        $this->addElements(array($idPersonne, $nomPersonne, $prenomPersonne, $dateNaissancePersonne, $telFixePersonne, $telMobilePersonne, $mailPersonne, $typePersonne, $Adresse_idAdresse, $pwd, $envoyer));
    }

}

