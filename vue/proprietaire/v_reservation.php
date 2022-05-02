<body>

<div class="contenu">

    <aside class="infos">

        <div class="info">

            <div class="enteteInfo">
                <h2>Information</h2>
            </div>

            <div class="contenuInfo">
                <p>Retrouvez ici toutes les réservations effectuées pour votre appartement, vous avez le pouvoir d'attribuer deux statuts :</p>
                <ul>
                    <li>Validé</li>
                    <li>Refusé</li>
                </ul>
            </div>

        </div>

    </aside>

    <div class="page">

        <div class="entetePage">
            <h1>Gestion de réservation - <?= $appartement->getTitre() ?></h1>
        </div>

        <div class="contenuPage">

            <table>
                <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Utilisateur</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Durée</th>
                    <th>Statut</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($reservations as $reservation) : ?>
                <tr>
                    <td><?= $reservation->getId() ?></td>
                    <td><?= $reservation->getUtilisateur() ?></td>
                    <td><?= date('d/m/Y', strtotime($reservation->getDateDebut())) ?></td>
                    <td><?= date('d/m/Y', strtotime($reservation->getDateFin())) ?></td>
                    <td><?= $reservation->getDuree() ?></td>
                    <td><?= $reservation->getEtat() ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>

    </div>

</div>