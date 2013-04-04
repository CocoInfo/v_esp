<?php

class Application_Model_DbTable_Animaux extends Zend_Db_Table_Abstract {


    protected $_name = 'animaux';

    public function obtenirAnimal($idAnimal)
    {
        $idAnimal = (int)$idAnimal;
//
//       $row = $this->fetchRow('idAnimal = ' . $idAnimal);
//        if (!$row) {
//            throw new Exception("Impossible de trouver l'enregistrement $idAnimal");
//        }
//       $result = $row->toArray();
//       return $result;
        
        
        
        $select = $this->getAdapter()->select()
                ->from(array('a' => 'animaux'),
                    array('idAnimal','prenomAnimal', 'dateNaissanceAnimal','type','Personne_idPersonne'))
                ->join(array('p' => 'personne'),
                        'a.Personne_idPersonne = p.idPersonne')
                ->where('a.idAnimal = ?',$idAnimal);
        $row =$select->query()->fetch();      
        
        if (!$row) {
            throw new Exception("Impossible de trouver l'animal $idAnimal");
        }
        return $row;
    }
    
    public function obtenirAnimaux()
    {
        $select = $this->getAdapter()->select()
                ->from(array('a' => 'animaux'),
                    array('idAnimal','prenomAnimal', 'dateNaissanceAnimal','type','Personne_idPersonne'))
                ->join(array('p' => 'personne'),
                        'a.Personne_idPersonne = p.idPersonne');
       $row = $select->query()->fetchAll(); 
        
        if (!$row) {
            throw new Exception("Impossible de trouver les annimaux !");
        }
        return $row;
    }
    
    
    

    public function ajouterAnimal($prenomAnimal, $dateNaissanceAnimal, $type, $Personne_idPersonne)
    {
        $data = array(
            'prenomAnimal' => $prenomAnimal,
            'dateNaissanceAnimal' => $dateNaissanceAnimal,
            'type' => $type,
            'Personne_idPersonne' => $Personne_idPersonne
        );
        $this->insert($data);
    }

    public function modifierAnimal($idAnimal, $prenomAnimal, $dateNaissanceAnimal, $type, $Personne_idPersonne)
    {
        $data = array(
            'prenomAnimal' => $prenomAnimal,
            'dateNaissanceAnimal' => $dateNaissanceAnimal,
            'type' => $type,
            'Personne_idPersonne' => $Personne_idPersonne
        );
        $this->update($data, 'idAnimal = '. (int)$idAnimal);
    }

    public function supprimerAnimal($idAnimal)
    {
        $this->delete('idAnimal =' . (int)$idAnimal);
    }

}