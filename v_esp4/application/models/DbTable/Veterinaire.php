<?php

class Application_Model_DbTable_Veterinaire extends Zend_Db_Table_Abstract {

    protected $_name = 'personne';

    public function obtenirVeterinaire($idPersonne) {
        $idPersonne = (int) $idPersonne;

        $select = $this->getAdapter()->select()
                ->from(array('p' => 'personne'),
                    array('idPersonne','nomPersonne','prenomPersonne', 'dateNaissancePersonne','telFixePersonne','telMobilePersonne','mailPersonne','typePersonne','Adresse_idAdresse', 'pwd'))
                ->join(array('a' => 'adresse'),
                        'p.Adresse_idAdresse = a.idAdresse')
                ->where('p.idPersonne = ?', $idPersonne)
                ->where('p.typePersonne = ?','Veterinaire');
       $row =$select->query()->fetch();        
        
        if (!$row) {
            throw new Exception("Impossible de trouver le vétérinaire $idPersonne");
        }
        return $row;
    }
    
    public function obtenirVeterinaires()
    {
        $select = $this->select()
                ->from(array('p' => 'personne'),
                    array('idPersonne','nomPersonne','prenomPersonne', 'dateNaissancePersonne','telFixePersonne','telMobilePersonne','mailPersonne','typePersonne','Adresse_idAdresse', 'pwd'))
                ->join(array('a' => 'adresse'),
                        array('idAdresse'),
                        'p.Adresse_idAdresse = a.idAdresse')
                ->where('typePersonne = ?','Veterinaire');
       $row =$select->query()->fetchAll(); 
        
        if (!$row) {
            throw new Exception("Impossible de trouver les vétérinaires !");
        }
        return $row->toArray();
    }

    public function ajouterVeterinaire($nomPersonne, $prenomPersonne, $dateNaissancePersonne, $telFixePersonne, $telMobilePersonne, $mailPersonne, $typePersonne, $Adresse_idAdresse, $pwd) {
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

    public function modifierVeterinaire($idPersonne, $nomPersonne, $prenomPersonne, $dateNaissancePersonne, $telFixePersonne, $telMobilePersonne, $mailPersonne, $typePersonne, $Adresse_idAdresse, $pwd) {
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

    public function supprimerVeterinaire($idPersonne) {
        $this->delete('idPersonne =' . (int) $idPersonne);
    }


}

