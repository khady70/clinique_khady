<?php require_once '../config.php';
require_role('patient');
$user = $_SESSION['user'];

// récupérer rendez-vous du patient
$stmt = $pdo->prepare('SELECT r.*, m.nom as m_nom, m.prenom as m_prenom, m.specialite FROM rendezvous r JOIN medecins m ON r.medecin_id = m.id WHERE r.patient_id = ? ORDER BY r.date_heure');
$stmt->execute([$user['profile']['id']]);
$rdvs = $stmt->fetchAll();
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Mon espace - Patient</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <header class="topbar"><a href="../logout.php">Se déconnecter</a></header>
  <main class="container">
    <h1>Bonjour <?php echo htmlspecialchars($user['profile']['prenom']); ?></h1>
    <a class="btn" href="prendre_rdv.php">Prendre un rendez-vous</a>

    <section>
      <h2>Mes rendez-vous</h2>
      <?php if (!$rdvs): ?>
        <p>Aucun rendez-vous.</p>
      <?php else: ?>
        <table>
          <thead><tr><th>Date / Heure</th><th>Médecin</th><th>Spécialité</th><th>Statut</th><th>Actions</th></tr></thead>
          <tbody>
            <?php foreach ($rdvs as $r): ?>
              <tr>
                <td><?php echo htmlspecialchars($r['date_heure']); ?></td>
                <td><?php echo htmlspecialchars($r['m_prenom'].' '.$r['m_nom']); ?></td>
                <td><?php echo htmlspecialchars($r['specialite']); ?></td>
                <td><?php echo htmlspecialchars($r['statut']); ?></td>
                <td>
                  <?php if ($r['statut'] === 'programmé'): ?>
                    <form method="post" action="actions.php" style="display:inline">
                      <input type="hidden" name="action" value="annuler">
                      <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
                      <button>Annuler</button>
                    </form>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </section>
  </main>
</body>
</html>
