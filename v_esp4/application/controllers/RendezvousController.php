<?php

class RendezvousController extends Zend_Controller_Action {

   

    public function init() {
        Zend_Dojo::enableView($this->view);
        
    }

    public function indexAction() {
        $rendezvous = new Application_Model_DbTable_Rendezvous();
        $this->view->$rendezvous = $rendezvous->fetchAll();
    }

    public function indexjsonAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $response = $this->getResponse();
        $response->setHeader('Content-type', 'application/json', true);
        $rendezvous = new Application_Model_DbTable_Rendezvous();
        $data = $rendezvous->fetchAll()->toArray();
//        $dataTab2 = array('identifier' => 'idcommune', 'items' => $data);
        //$dataArray = array('identifier' => 'idpersonne', 'items' => $data);
        $json = Zend_Json::encode($dataArray);
//       Zend_Json::encode($json)
        return $response->setBody($json);
    }

    public function ajouterAction() {
        $form = new Application_Form_Rendezvous();
        $form->envoyer->setLabel('Ajouter');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $nom = $form->getValue('nom');
                $prenom = $form->getValue('prenom');
                $date_naissance = $form->getValue('date_naissance');
                $adresse = $form->getValue('adresse');
                $phone = $form->getValue('phone');
                $mail = $form->getValue('mail');
                $idcommune = $form->getValue('commune_idcommune');
                $rendezvous = new Application_Model_DbTable_Rendezvous();
                if (empty($idcommune)) {
                    $idcommune = null;
                }
                $rendezvous->ajouterRendezvous($nom, $prenom, $date_naissance, $adresse, $phone, $mail, $idcommune);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function modifierAction() {
        $form = new Application_Form_Rendezvous();
        $form->envoyer->setLabel('Sauvegarder');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $this->_getParam('id', 0);
                $nom = $form->getValue('nom');
                $prenom = $form->getValue('prenom');
                $date_naissance = $form->getValue('date_naissance');
                $adresse = $form->getValue('adresse');
                $phone = $form->getValue('phone');
                $mail = $form->getValue('mail');
                $idcommune = $form->getValue('commune_idcommune');
                if(empty($idcommune)){
                $idcommune = null;
                }
                $rendezvous = new Application_Model_DbTable_Rendezvous();
                try {
                    $rendezvous->modifierRendezvous($id, $nom, $prenom, $date_naissance, $adresse, $phone, $mail, $idcommune);
                } catch (Exception $e) {
                    $this->getLog()->log("modifier Personne : " . $e, Zend_Log::ERR);
                }
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $rendezvous = new Application_Model_DbTable_Rendezvous();
                $form->populate($rendezvous->obtenirRendezvous($id));
            }
        }
    }

    public function supprimerAction() {
        if ($this->getRequest()->isPost()) {
            $supprimer = $this->getRequest()->getPost('supprimer');
            if ($supprimer == 'Oui') {
                $id = $this->getRequest()->getPost('idpersonne');
                $rendezvous = new Application_Model_DbTable_Rendezvous();
                $rendezvous->supprimerRendezvous($id);
            }

            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $rendezvous = new Application_Model_DbTable_Rendezvous();
            $this->view->personne = $rendezvous->obtenirRendezvous($id);
        }
    }
    
    public function getLog()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }

}