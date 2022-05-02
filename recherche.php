<?php
    $titre = "Rythm Break";
    $h1 = "Rythm Break";
    $link = "./css/styles-standards.css";
    $descrip = "Projet de DÃ©veloppement Web";
    require "./include/header.inc.php";

    if(isset($_GET["nom"]) && !empty($_GET["nom"])) {
        $search = urldecode($_GET["nom"]);
    }
   
?> 

    <main>
        <section>
            <h2>Cherchez vos chansons favorites</h2>
            <article>

                <h3>Recherchez</h3>
                <form action="recherche.php" method="get">
                    <fieldset>
                        <legend style="color:cyan">Rythm Break</legend>
                        <label for="mychoices">taper le nom de l'artiste</label>
                        <input type="text" id="mychoices" name="nom" placeholder="Choisir un nom" value="<?php echo $search; ?>" />
                        <label for="mychoices">choisir le genre </label>
                        <select name="type">
                            <option value="singer" <?php if($_GET['type']=='singer') echo 'selected="selected"';?> > Artiste </option>
                            <option value="album" <?php if($_GET['type']=='album') echo 'selected="selected"';?> > Album </option>
                            <option value="song" <?php if($_GET['type']=='song') echo 'selected="selected"';?> > Musique </option>
                        </select>
                        <input type="submit" value="rechercher" />  	
                    </fieldset>
                </form>

                <?php
                if(isset($_GET["nom"]) && (isset($_GET["type"])) && (!empty($_GET["nom"])) && $_GET["type"] == "singer"){
                    $nomart = getArtists(urlencode($_GET["nom"]));
                    
                    echo "<h4>Liste des Artistes</h4>";
                    if(empty($nomart)) {
                        echo "<p style='color:white; padding-right: 1%;'>Aucun résultat trouvé</p> \n";
                    }
                    echo "<div class='grid-container'> \n";
                    foreach($nomart as $key => $value) {
           
                        $artist = urlencode($value);
                        $id = getIdArtist($value);  
                        $urlPicture = getArtistPicture($id); 
                        echo "<div class='grid-item'> \n";
                        echo "<figure> \n";
                        echo "<a href='informations.php?artist=$artist&id=$id'> \n";
                        echo "<img src='$urlPicture' alt='image de lartiste' width='250' height='250' /> \n";
                        echo "</a> \n";
                        echo "</figure> \n";
                        echo "<figcaption> \n";
                        echo "<h5>".$value."</h5> \n";
                        echo "</figcaption> \n";
                        echo "</div> \n";
                    }
                    echo "</div> \n";
                   
                }  else if(empty($_GET["nom"]) && (isset($_GET["type"])) && $_GET["type"] == "singer"){
                        echo "<h4>Liste des Artistes</h4>";
                        echo "<p style='color:white; padding-right: 1%;'>Aucun résultat trouvé</p> \n";  
                }

                if(isset($_GET["nom"]) && (isset($_GET["type"])) && (!empty($_GET["nom"])) && $_GET["type"] == "album"){
                    $nomalb = getAlbums(urlencode($_GET["nom"]));
                    echo '<section>';
                    echo "<h4>Liste des Albums</h4>";
                    if(empty($nomalb)) {
                        echo "<p style='color:white; padding-right: 1%;'>Aucun résultat trouvé</p> \n";
                    }
                    echo "<ol class='centerItems'>";
                    for ($i=0; $i<sizeof($nomalb); $i++) {
                        echo '<article class="is">';
                        echo "<li style='color:white; padding-right: 1%;'><table class='listeItemClass'><tr><td>".$nomalb[$i]->name."</td>";
                        echo "<td> Artiste : ".$nomalb[$i]->artist."</td>";
                        echo '<td>  <form action="informations.php" method="get">
                                    <input type="hidden" name="album" value='.urlencode($nomalb[$i]->name).' />
                                    <input type="hidden" name="artiste" value='.urlencode($nomalb[$i]->artist).' />
                                    <input type="submit" value="Details" />
                                    </form>
                        </td></tr></table></li>';
                        echo "</article>";
                    }
                    echo "</ol>";
                    echo "</section>";
                } else if(empty($_GET["nom"]) && (isset($_GET["type"])) && $_GET["type"] == "album"){
                    echo "<section>";
                    echo "<h4>Liste des Albums</h4>";
                    echo "<p style='color:white; padding-right: 1%;'>Aucun résultat trouvé</p> \n";
                    echo "</section>";
                }

                if(isset($_GET["nom"]) && (isset($_GET["type"])) && (!empty($_GET["nom"])) && $_GET["type"] == "song"){
                    $songs = getTracks(urlencode($_GET["nom"]));
                    echo '<section>';
                    echo "<h4>Liste des Musiques</h4>";
                    if(empty($songs)) {
                        echo "<p style='color:white; padding-right: 1%;'>Aucun résultat trouvé</p> \n";
                    }
                    echo "<ol class='centerItems'>";
                    for ($i=0; $i<sizeof($songs); $i++) {
                        echo '<article class="is">';
                        echo '<li><img src="./images/noimage.jpg" height="30" width="30" alt="song image"/></li>';
                        echo "<li style='color:white';><table class='listeItemClass'><tr><td>".$songs[$i]->name."</td>";
                        echo "<td> Artiste : ".$songs[$i]->artist."</td>";
                        echo '<td>  <form action="informations.php" method="get">
                                    <input type="hidden" name="songs" value='.urlencode($songs[$i]->name).' />
                                    <input type="hidden" name="artiste" value='.urlencode($songs[$i]->artist).' />
                                    <input type="submit" value="Details" />
                                    </form>
                        </td></tr></table></li>';
                        echo "</article>";
                    }
                    echo "</ol>";
                    echo "</section>";
                } else if(empty($_GET["nom"]) && (isset($_GET["type"])) && $_GET["type"] == "song"){
                    echo "<section>";
                    echo "<h4>Liste des Musiques</h4>";
                    echo "<p style='color:white; padding-right: 1%;'>Aucun résultat trouvé</p> \n";
                    echo "</section>";
                }
            ?>
            
            </article>
        </section> 
    </main>

<?php
   require "./include/footer.inc.php";
?>