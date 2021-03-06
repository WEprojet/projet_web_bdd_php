<?php
/**
 * Page gestionMusique.php
 * Affiche et propose de modifier et supprimer une musique
 */

session_start();
include_once(dirname(__FILE__).'/../../fonctions/variables.php');
include_once(dirname(__FILE__).'/../../fonctions/fonctionCompte.php');
include_once(dirname(__FILE__).'/../../fonctions/fonctionArtiste.php');
include_once(dirname(__FILE__).'/../../fonctions/fonctionAlbum.php');
include_once(dirname(__FILE__).'/../../fonctions/fonctionGenre.php');
include_once(dirname(__FILE__).'/../../fonctions/fonctionMusique.php');
include_once(dirname(__FILE__).'/../../bdd/connexion.php');

$info['head']['subTitle'] = "Gestion musique";
$info['head']['stylesheets'] = ['adminGestion.css'];

if(!is_connect() || !is_admin()) {leave();}

include_once(dirname(__FILE__).'/actionMusique.php');

if ( isset($db) ) {
    $listeMusique = recuperer_musique_tous($db);
}

include_once(dirname(__FILE__).'/../../head.php');

?>

<?php include_once(dirname(__FILE__).'/../../header.php'); ?>

<main>
    <section>
        <?php include_once(dirname(__FILE__) . '/../headerAdmin.php'); ?>
        <div>
            <?php include_once(dirname(__FILE__).'/headerMusique.php'); ?>
            <div>

                <!-- TABLEAU
                    Titre Musique - Durée - Date - Description
                -->
                <table id="tableauGestion">
                    
                    <tr class="table-head">
                        <th class="width-350">Tite musique</th>
                        <th class="width-200">Durée</th>
                        <th class="width-200">Date</th>
                        <th class="width-600">Description</th>
                    </tr>

                    <?php foreach($listeMusique as $musique) { ?>
                    <tr class="table-lign">
                        <td> <?php echo ucwords($musique['titremusique']); ?> </td>
                        <td> <?php echo format_duree($musique['dureemusique']); ?> </td>
                        <td> <?php echo affichage_date($musique['datemusique']); ?> </td>
                        <td> <?php echo $musique['descriptionmusique']; ?> </td>
                        <td class="bouton bouton-forme1 bouton-bleu">
                            <a href="./formMusique.php?idMusique=<?php echo $musique['idmusique'] ?>">Modifier</a>
                        </td>
                        <td class="bouton bouton-forme1 bouton-red">
                            <a href="./gestionMusique.php?action=supprimerMusique&idMusique=<?php echo $musique['idmusique'] ?>">Supprimer</a>
                        </td>
                    </tr>
                    <?php } ?>

                </table>
                <!-- FIN TABLEAU -->

            </div>
        </div>
    </section>
</main>

<?php include_once(dirname(__FILE__).'/../../footer.php'); ?>