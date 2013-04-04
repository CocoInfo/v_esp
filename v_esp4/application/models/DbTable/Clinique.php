<?php

class Application_Model_DbTable_Clinique extends Zend_Db_Table_Abstract {

    protected $_name = 'clinique';

    public function obtenirClinique($idClinique) {
        $idClinique = (int) $idClinique;
        
        $select = $this->getAdapter()->select()
                ->from(array('c' => 'clinique'),
                    array('idClinique','nomClinique','proprietaireClinique', 'telClinique','mailClinique','Adresse_idAdresse'))
                ->join(array('a' => 'adresse'),
                        'c.Adresse_idAdresse = a.idAdresse')
                ->where('c.idClinique = ?',$idClinique);
       $row =$select->query()->fetch();        
        
        if (!$row) {
            throw new Exception("Impossible de trouver la clinique $idClinique");
        }
        return $row;
    }
    
    public function obtenirCliniques()
    {
        $select = $this->select()
                ->from(array('c' => 'clinique'),
                    array('idClinique','nomClinique','proprietaireClinique', 'telClinique','mailClinique','Adresse_idAdresse'))
                ->join(array('a' => 'adresse'),
                        array('idAdresse'),
                        'c.Adresse_idAdresse = a.idAdresse');
       $row =$select->query()->fetchAll(); 
        
        if (!$row) {
            throw new Exception("Impossible de trouver les cliniques !");
        }
        return $row->toArray();
    }

    public function ajouterClinique($nomClinique, $proprietaireClinique, $telClinique, $mailClinique,$Adresse_idAdresse) {
        $data = array(
            'nomClinique' => $nomClinique,
            'proprietaireClinique' => $proprietaireClinique,
            'telClinique' => $telClinique,
            'mailClinique' => $mailClinique,
            'Adresse_idAdresse' => $Adresse_idAdresse
        );
        $this->insert($data);
    }

    public function modifierClinique($idClinique, $nomClinique, $proprietaireClinique, $telClinique, $mailClinique,$Adresse_idAdresse) {
        $data = array(
            'idClinique' => $idClinique,
            'nomClinique' => $nomClinique,
            'proprietaireClinique' => $proprietaireClinique,
            'telClinique' => $telClinique,
            'mailClinique' => $mailClinique,
            'Adresse_idAdresse' => $Adresse_idAdresse
        );
        $this->update($data, 'idClinique = ' . (int) $idClinique);
    }

    public function supprimerClinique($idClinique) {
        $this->delete('idClinique =' . (int) $idClinique);
    }


}