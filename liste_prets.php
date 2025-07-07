<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/models/Pret.php';

Flight::route('GET /liste_prets.php', function() {
    $prets = Pret::getAll();
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Liste des Prêts</title>
        <style>
            body { font-family: sans-serif; padding: 20px; }
            table { border-collapse: collapse; width: 100%; margin-top: 20px; }
            th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
        </style>
    </head>
    <body>
        <h1>Liste des Prêts</h1>
        <a href="insert_pret.php">Ajouter un prêt</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client ID</th>
                    <th>Type de Prêt</th>
                    <th>Montant</th>
                    <th>Taux d'intérêt</th>
                    <th>Durée (mois)</th>
                    <th>Date Début</th>
                    <th>Date Fin</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prets as $pret): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($pret['id_pret']); ?></td>
                        <td><?php echo htmlspecialchars($pret['id_client']); ?></td>
                        <td><?php echo htmlspecialchars($pret['id_type_pret']); ?></td>
                        <td><?php echo htmlspecialchars($pret['montant']); ?></td>
                        <td><?php echo htmlspecialchars($pret['taux_interet']); ?>%</td>
                        <td><?php echo htmlspecialchars($pret['duree_mois']); ?></td>
                        <td><?php echo htmlspecialchars($pret['date_debut']); ?></td>
                        <td><?php echo htmlspecialchars($pret['date_fin']); ?></td>
                        <td><?php echo htmlspecialchars($pret['statut']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
    </html>
    <?php
});

Flight::start();