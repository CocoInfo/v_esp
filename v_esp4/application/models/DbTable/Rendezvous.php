<?php

class Application_Model_DbTable_Rendezvous extends Zend_Db_Table_Abstract {

    protected $_name = 'rendezvous';

    public function obtenirRendezvous($Clinique_idClinique, $Animaux_idAnimal, $Personne_idPersonne) {
        $id = (int) $id;
        $row = $this->fetchRow('Clinique_idClinique = '.$Clinique_idClinique.' and Animaux_idAnimal = '.$Animaux_idAnimal.' and Personne_idPersonne = '.$Personne_idPersonne);
        if (!$row) {
            throw new Exception("Impossible de trouver l'enregistrement $Clinique_idClinique");
        }
        return $row->toArray();
    }

    public function ajouterRendezvous($date, $heure, $Clinique_idClinique, $Animaux_idAnimal) {
        $data = array(
            'date' => $date,
            'heure' => $heure,
            'Clinique_idClinique' => $Clinique_idClinique,
            'Animaux_idAnimal' => $Animaux_idAnimal,
            'Personne_idPersonne' => $Personne_idPersonne
        );
        $this->insert($data);
    }

    public function modifierRendezvous($date, $heure, $Clinique_idClinique, $Animaux_idAnimal, $Personne_idPersonne) {
        $data = array(
            'date' => $date,
            'heure' => $heure,
            'Clinique_idClinique' => $Clinique_idClinique,
            'Animaux_idAnimal' => $Animaux_idAnimal,
            'Personne_idPersonne' => $Personne_idPersonne
        );
        $this->update($data, 'Clinique_idClinique = ' . (int) $Clinique_idClinique);
    }

    public function supprimerRendezvous($id) {
        $this->delete('idpersonne =' . (int) $id);
    }


}

