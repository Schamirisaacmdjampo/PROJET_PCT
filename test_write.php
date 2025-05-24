<?php
if (is_writable('uploads')) {
    echo "Le dossier uploads est accessible en écriture.";
} else {
    echo "Le dossier uploads n'est PAS accessible en écriture.";
}
