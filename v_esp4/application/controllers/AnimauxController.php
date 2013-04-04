<?php

class AnimauxController extends Zend_Controller_Action {

   


    public function init()
    {
        Zend_Dojo::enableView($this->view);
    }

    public function indexAction()
    {
    }
    
    public function animallistAction() {
        $animaux = new Application_Model_DbTable_Animaux();
       
        $result = $animaux->obtenirAnimaux();
        
        
        $data = new Zend_Dojo_Data('idAnimal', $result);
        $this->_helper->autoCompleteDojo($data);
    }
    
    public function indexjsonAction() {

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $animaux = new Application_Model_DbTable_Animaux();
        
        
        
        
        $dojoData = new Zend_Dojo_Data('idAnimal', $animaux->obtenirAnimaux(), 'idAnimal');
//        $dojoData = new Zend_Dojo_Data('idAnimal', $animaux->obtenirAnimal('14'), 'idAnimal'); //pour test animal
        $response = $this->getResponse();
        $response->setHeader('Content-type', 'application/json', true);
        $response->setBody($dojoData);
    }

    public function ajouterAction()
    {
        $form = new Application_Form_Animaux();
        $form->envoyer->setLabel('Ajouter');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $prenomAnimal = $form->getValue('prenomAnimal');
                $dateNaissanceAnimal = $form->getValue('dateNaissanceAnimal');
                $Personne_idPersonne = $form->getValue('Personne_idPersonne');
                $type = $form->getValue('type');
                $animaux = new Application_Model_DbTable_Animaux();
                $animaux->ajouterAnimal($prenomAnimal, $dateNaissanceAnimal, $type, $Personne_idPersonne);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function modifierAction()
    {
        $form = new Application_Form_Animaux();
        $form->envoyer->setLabel('Sauvegarder');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $idAnimal = $form->getValue('idAnimalM');
                $prenomAnimal = $form->getValue('prenomAnimal');
                $dateNaissanceAnimal = $form->getValue('dateNaissanceAnimal');
                $Personne_idPersonne = $form->getValue('Personne_idPersonne');
                $type = $form->getValue('type');
                $animaux = new Application_Model_DbTable_Animaux();
                $animaux->modifierAnimal($idAnimal, $prenomAnimal, $dateNaissanceAnimal, $type, $Personne_idPersonne);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $idAnimal = $this->_getParam('idAnimalM', 0);
            if ($idAnimal > 0) {
                $animaux = new Application_Model_DbTable_Animaux();
                $form->populate($animaux->obtenirAnimal($idAnimal));
            }
        }
    }

    public function supprimerAction()
    {
        if ($this->getRequest()->isPost()) {
            $supprimer = $this->getRequest()->getPost('supprimer');
            if ($supprimer == 'Oui') {
                $idAnimal = $this->getRequest()->getPost('idAnimalS');
                $animaux = new Application_Model_DbTable_Animaux();
                $animaux->supprimerAnimal($idAnimal);
            }

            $this->_helper->redirector('index');
            
        } else {
            $idAnimal = $this->_getParam('idAnimalS', 0);
            $animaux = new Application_Model_DbTable_Animaux();
            $this->view->Animal = $animaux->obtenirAnimal($idAnimal);
        }
    }

}