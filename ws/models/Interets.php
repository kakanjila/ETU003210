<?php
require_once __DIR__ . '/../db.php';

class Interets {
    
    /**
     * Calcule les intérêts gagnés par mois pour l'établissement financier
     */
    public static function getInteretsParMois($dateDebut, $dateFin, $idEtablissement = null) {
        $db = getDB();
        
        $whereEtablissement = "";
        $params = [$dateDebut, $dateFin];
        
        if ($idEtablissement) {
            $whereEtablissement = "AND ef.id_etablissement = ?";
            $params[] = $idEtablissement;
        }
        
        $query = "
            SELECT 
                DATE_FORMAT(p.date_debut, '%Y-%m') as mois_annee,
                DATE_FORMAT(p.date_debut, '%M %Y') as mois_annee_affichage,
                COUNT(p.id_pret) as nombre_prets,
                SUM(p.montant) as montant_total_prets,
                SUM(p.montant * p.taux_interet / 100 / 12) as interets_mensuels,
                SUM(p.montant * p.taux_interet / 100 / 12 * p.duree_mois) as interets_totaux,
                AVG(p.taux_interet) as taux_moyen
            FROM prets p
            JOIN types_pret tp ON p.id_type_pret = tp.id_type_pret
            JOIN etablissement_financier ef ON tp.id_etablissement = ef.id_etablissement
            WHERE p.date_debut BETWEEN ? AND ?
            AND p.statut IN ('ACTIF', 'PAYE')
            $whereEtablissement
            GROUP BY DATE_FORMAT(p.date_debut, '%Y-%m')
            ORDER BY mois_annee ASC
        ";
        
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Calcule les intérêts basés sur les paiements effectués
     */
    public static function getInteretsParMoisAvecPaiements($dateDebut, $dateFin, $idEtablissement = null) {
        $db = getDB();
        
        $whereEtablissement = "";
        $params = [$dateDebut, $dateFin];
        
        if ($idEtablissement) {
            $whereEtablissement = "AND ef.id_etablissement = ?";
            $params[] = $idEtablissement;
        }
        
        $query = "
            SELECT 
                DATE_FORMAT(pp.date_paiement, '%Y-%m') as mois_annee,
                DATE_FORMAT(pp.date_paiement, '%M %Y') as mois_annee_affichage,
                COUNT(DISTINCT pp.id_pret) as nombre_prets,
                SUM(pp.montant_paye) as montant_paye_total,
                SUM(pp.montant_paye * p.taux_interet / 100 / 12) as interets_mensuels,
                SUM(pp.montant_paye * p.taux_interet / 100 / 12 * p.duree_mois) as interets_totaux,
                AVG(p.taux_interet) as taux_moyen
            FROM paiements_pret pp
            JOIN prets p ON pp.id_pret = p.id_pret
            JOIN types_pret tp ON p.id_type_pret = tp.id_type_pret
            JOIN etablissement_financier ef ON tp.id_etablissement = ef.id_etablissement
            WHERE pp.date_paiement BETWEEN ? AND ?
            AND p.statut IN ('ACTIF', 'PAYE')
            $whereEtablissement
            GROUP BY DATE_FORMAT(pp.date_paiement, '%Y-%m')
            ORDER BY mois_annee ASC
        ";
        
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Calcule les intérêts avec la formule de l'annuité constante
     */
    public static function getInteretsAnnuiteConstante($dateDebut, $dateFin, $idEtablissement = null) {
        $db = getDB();
        
        $whereEtablissement = "";
        $params = [$dateDebut, $dateFin];
        
        if ($idEtablissement) {
            $whereEtablissement = "AND ef.id_etablissement = ?";
            $params[] = $idEtablissement;
        }
        
        $query = "
            SELECT 
                DATE_FORMAT(p.date_debut, '%Y-%m') as mois_annee,
                DATE_FORMAT(p.date_debut, '%M %Y') as mois_annee_affichage,
                COUNT(p.id_pret) as nombre_prets,
                SUM(p.montant) as montant_total_prets,
                SUM(
                    p.montant * (p.taux_interet / 100 / 12) * 
                    POWER(1 + p.taux_interet / 100 / 12, p.duree_mois) / 
                    (POWER(1 + p.taux_interet / 100 / 12, p.duree_mois) - 1)
                ) as annuite_constante,
                SUM(p.montant * p.taux_interet / 100 / 12) as interets_mensuels_simple,
                AVG(p.taux_interet) as taux_moyen
            FROM prets p
            JOIN types_pret tp ON p.id_type_pret = tp.id_type_pret
            JOIN etablissement_financier ef ON tp.id_etablissement = ef.id_etablissement
            WHERE p.date_debut BETWEEN ? AND ?
            AND p.statut IN ('ACTIF', 'PAYE')
            $whereEtablissement
            GROUP BY DATE_FORMAT(p.date_debut, '%Y-%m')
            ORDER BY mois_annee ASC
        ";
        
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Récupère tous les établissements financiers
     */
    public static function getEtablissements() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM etablissement_financier ORDER BY nom");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Calcule les statistiques globales
     */
    public static function getStatistiquesGlobales($dateDebut, $dateFin, $idEtablissement = null) {
        $db = getDB();
        
        $whereEtablissement = "";
        $params = [$dateDebut, $dateFin];
        
        if ($idEtablissement) {
            $whereEtablissement = "AND ef.id_etablissement = ?";
            $params[] = $idEtablissement;
        }
        
        $query = "
            SELECT 
                COUNT(p.id_pret) as total_prets,
                SUM(p.montant) as montant_total,
                AVG(p.taux_interet) as taux_moyen,
                SUM(p.montant * p.taux_interet / 100 / 12 * p.duree_mois) as interets_totaux
            FROM prets p
            JOIN types_pret tp ON p.id_type_pret = tp.id_type_pret
            JOIN etablissement_financier ef ON tp.id_etablissement = ef.id_etablissement
            WHERE p.date_debut BETWEEN ? AND ?
            AND p.statut IN ('ACTIF', 'PAYE')
            $whereEtablissement
        ";
        
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?> 