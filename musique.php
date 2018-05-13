<?php

session_start();
include_once(dirname(__FILE__).'/fonctions/variables.php');
include_once(dirname(__FILE__).'/fonctions/fonctionCompte.php');
include_once(dirname(__FILE__).'/fonctions/fonctionMusique.php');
include_once(dirname(__FILE__).'/bdd/connexion.php');

$info['head']['subTitle'] = "Page musique";
$info['head']['stylesheets'] = ['musique.css'];

$idMusique = $_GET['idMusique'];
if ( isset($db, $idMusique) ) {
    $musique = recuperer_musique($db, $idMusique)[0];
    if ( empty($musique) ) {
        header('Location: /index.php');
    }
    $listeArtistesMusique = recuperer_artiste_musique($db, $idMusique);
} else {
    header('Location: /index.php');
}

include_once(dirname(__FILE__).'/head.php');

?>

<?php include_once(dirname(__FILE__).'/header.php'); ?>


<main>
    <section>
        <div id="barre-recherche">
            <form class="flex flex-center item-center">
                <span class="t20">Nouvelle recherche : </span>
                <input id="input-recherche"
                       type="text"
                       class="width-500"
                       name="recherche"
                       placeholder="Artiste, groupe, album ou musique"
                       />
                <input class="button" type="submit" value="Rechercher" />
            </form>
        </div>
        
        <!-- Présentation de la musique -->
        <div id="page-musique">
            <div class="flex flex-between">
                <div id="description-album" class="flex-around">
                    <div>
                        <h1 class="red1"><?php echo $musique['titremusique']; ?> - <?php echo $musique['datemusique']; ?></h1>
                        <div>
                            <?php if ( !empty($musique['descriptionmusique']) ) {
                                    echo $musique['descriptionmusique'];
                                } else { ?>
                                <p>Cette musique ne contient pas de description...</p>
                                <?php } ?>
                        </div>
                        <div>
                            <?php if ( !empty($listeArtistesMusique) ) { ?>
                                <?php if ( sizeof($listeArtistesMusique) > 1 ) { echo "Artistes : "; } else { echo "Artiste : "; } ?>
                                <?php foreach($listeArtistesMusique as $key => $artiste) { ?>
                                    <a class="souligner" href="/artiste.php?idArtiste=<?php echo $artiste['idartiste']; ?>">
                                        <?php if ( !empty($artiste['nomscene']) ) {
                                            echo $artiste['nomscene'];
                                        } else {
                                            echo $artiste['nomartiste'].' '.$artiste['prenomartiste'];
                                        } ?>
                                    </a>
                                    <?php if ( sizeof($listeArtistesMusique) > 1 && sizeof($listeArtistesMusique)-1 > $key ) { echo '&nbsp-&nbsp'; } ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <!--p>
                            [Optionnel] Cette musique a été composé en collaboration avec <a>Nom_Artistes</a>
                        </p>
                        <p>
                            C'est la piste numero <a>Numero_Piste</a> de l'album <a>Nom_Album1</a><br>
                            C'est la piste numero <a>Numero_Piste</a> de l'album <a>Nom_Album2</a><br>
                            [Ou]<br>
                            Ce morceau est un single, il ne fait pas partie d'un album.
                        </p-->
                    </div>
                </div>
            </div>

            <?php include_once(dirname(__FILE__).'/commentaireMusique.php'); ?>
        
        </div>
    </section>
</main>

<?php include_once(dirname(__FILE__).'/footer.php'); ?>

