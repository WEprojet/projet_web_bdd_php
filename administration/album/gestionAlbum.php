<?php

/**
 * Page gestionAlbum.php
 * Affiche et propose de modifier et supprimer un album
 */

session_start();
include_once(dirname(__FILE__).'/../../fonctions/variables.php');
include_once(dirname(__FILE__).'/../../fonctions/fonctionCompte.php');
include_once(dirname(__FILE__).'/../../fonctions/fonctionAlbum.php');
include_once(dirname(__FILE__).'/../../bdd/connexion.php');

$info['head']['subTitle'] = "Gestion groupe";
$info['head']['stylesheets'] = ['adminGestion.css'];

if(!is_connect() || !is_admin()) {leave();}

include_once(dirname(__FILE__).'/actionAlbum.php');

if ( isset($db) ){
  $listeAlbums = recuperer_album_tous($db);
}

include_once(dirname(__FILE__).'/../../head.php');

?>

<?php include_once(dirname(__FILE__).'/../../header.php'); ?>

<main>
    <section>
        <?php include_once(dirname(__FILE__) . '/../headerAdmin.php'); ?>
        <div>
            <?php include_once(dirname(__FILE__).'/headerAlbum.php'); ?>
            <div>
                
                <!-- TABLEAU
                    Nom Album - Date - Description
                -->
                <table id="tableauGestion">

                    <tr class="table-head">
                        <th class="width-350">Nom Album</th>
                        <th class="width-250">Date</th>
                        <th class="width-700">Description</th>
                    </tr>

                    <!-- Liste Albums -->
                    <?php foreach($listeAlbums as $album) { ?>
                    <tr class="table-lign">
                        <td> <?php echo ucwords($album['nomalbum']); ?> </td>
                        <td> <?php echo affichage_date($album['datealbum']); ?> </td>
                        <td> <?php echo $album['descriptionalbum']; ?> </td>
                        <td class="bouton bouton-forme1 bouton-bleu">
                            <a href="./formAlbum.php?idAlbum=<?php echo $album['idalbum']; ?>">Modifier</a>
                        </td>
                        <td class="bouton bouton-forme1 bouton-cyan">
                            <a href="./gestionAssemblerAlbum.php?idAlbum=<?php echo $album['idalbum']; ?>">Gestion musique</a>
                        </td>
                        <td class="bouton bouton-forme1 bouton-red">
                            <a href="?action=supprimerAlbum&idAlbum=<?php echo $album['idalbum']; ?>">Supprimer</a>
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
