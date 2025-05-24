<?php

include(__DIR__ . '/../templates/header.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
?>

<h2>Faire une demande d’acte</h2>
<p>Veuillez choisir le type d’acte que vous souhaitez demander :</p>

<div style="display: flex; flex-direction: column; gap: 1rem; max-width: 300px; position: relative;">
    <!-- Bouton Extrait de naissance avec menu déroulant -->
    <button id="btnExtrait" class="btn" type="button">Extrait de naissance ▼</button>

    <div id="menuExtrait" style="display:none; border:1px solid #ccc; padding:10px; background:#fff; position: absolute; top: 2.5rem; left: 0; width: 100%; z-index: 10;">
        <a href="nouvelle_naissance.php" style="display: block; padding: 5px 0;">Nouvelle demande</a>
        <a href="renouvellement_naissance.php" style="display: block; padding: 5px 0;">Renouvellement</a>
    </div>

    <!-- Les autres liens restent inchangés -->
    <a href="mariage.php" class="btn">Acte de mariage</a>
    <a href="deces.php" class="btn">Acte de décès</a>
</div>

<script>
  const btn = document.getElementById('btnExtrait');
  const menu = document.getElementById('menuExtrait');

  btn.addEventListener('click', () => {
    if (menu.style.display === 'none') {
      menu.style.display = 'block';
    } else {
      menu.style.display = 'none';
    }
  });

  // Fermer le menu si on clique en dehors
  document.addEventListener('click', (e) => {
    if (!btn.contains(e.target) && !menu.contains(e.target)) {
      menu.style.display = 'none';
    }
  });
</script>

<?php   
include(__DIR__ . '/../templates/footer.php');
?>
