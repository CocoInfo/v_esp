<?php

class Application_Model_DbTable_Personne extends Zend_Db_Table_Abstract {

    protected $_name = 'personne';

    public function obtenirPersonne($idPersonne) {
        $idPersonne = (int) $idPersonne;
        /*$row = $this->fetchRow('idPersonne = ' . $idPersonne);*/

        $select = $this->getAdapter()->select()
                ->from(array('p' => 'personne'),
                    array('idPersonne','nomPersonne','prenomPersonne', 'dateNaissancePersonne','telFixePersonne','telMobilePersonne','mailPersonne','typePersonne','Adresse_idAdresse', 'pwd'))
                ->join(array('a' => 'adresse'),
                        'p.Adresse_idAdresse = a.idAdresse')
                ->where('p.idPersonne = ?', $idPersonne)
                ->where('typePersonne = ?','Proprietaire');
       $row =$select->query()->fetch();        
        
        if (!$row) {
            throw new Exception("Impossible de trouver la personne $idPersonne");
        }
        return $row;
    }
    
    public function obtenirPersonnes()
    {
        $select = $this->select()
                ->from(array('p' => 'personne'),
                    array('idPersonne','nomPersonne','prenomPersonne', 'dateNaissancePersonne','telFixePersonne','telMobilePersonne','mailPersonne','typePersonne','Adresse_idAdresse', 'pwd'))
                ->join(array('a' => 'adresse'),
                        array('idAdresse'),
                        'p.Adresse_idAdresse = a.idAdresse')
                ->where('typePersonne = ?','Proprietaire');
       $row =$select->query()->fetchAll(); 
        
        if (!$row) {
            throw new Exception("Impossible de trouver les personnes !");
        }
        return $row->toArray();
    }

    public function ajouterPersonne($nomPersonne, $prenomPersonne, $dateNaissancePersonne, $telFixePersonne, $telMobilePersonne, $mailPersonne, $typePersonne, $Adresse_idAdresse, $pwd) {
        $data = array(
            'nomPersonne' => $nomPersonne,
            'prenomPersonne' => $prenomPersonne,
            'dateNaissancePersonne' => $dateNaissancePersonne,
            'telFixePersonne' => $telFixePersonne,
            'telMobilePersonne' => $telMobilePersonne,
            'mailPersonne' => $mailPersonne,
            'typePersonne' => $typePersonne,
            'Adresse_idAdresse' => $Adresse_idAdresse,
            'pwd' => $pwd
        );
        $this->insert($data);
    }

    public function modifierPersonne($idPersonne, $nomPersonne, $prenomPersonne, $dateNaissancePersonne, $telFixePersonne, $telMobilePersonne, $mailPersonne, $typePersonne, $Adresse_idAdresse, $pwd) {
        $data = array(
            'nomPersonne' => $nomPersonne,
            'prenomPersonne' => $prenomPersonne,
            'dateNaissancePersonne' => $dateNaissancePersonne,
            'telFixePersonne' => $telFixePersonne,
            'telMobilePersonne' => $telMobilePersonne,
            'mailPersonne' => $mailPersonne,
            'typePersonne' => $typePersonne,
            'Adresse_idAdresse' => $Adresse_idAdresse,
            'pwd' => $pwd
        );
        $this->update($data, 'idPersonne = ' . (int) $idPersonne);
    }

    public function supprimerPersonne($idPersonne) {
        $this->delete('idPersonne =' . (int) $idPersonne);
    }


}

