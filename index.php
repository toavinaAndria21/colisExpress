<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colis Express</title>
    <link rel="stylesheet" href="./loginStyles.css">
    
</head>
<body>
<div class="wrapper" id="login">

    <form id ="formConnexion" class="form_connexion">

                            <div class="container">
                                <h2>Connexion</h2>
                            <div class="input-box">
                                    <input type="email" id="email_input" name="email" pattern=".+@gmail\.com" autocomplete = "off" required >
                                    <label for="email">Email</label>
                            </div>
                            <div class="input-box">
                                    <input type="password" id="mdp_input" name="mdp" autocomplete = "off" required >
                                    <label for="mdp">Mot de passe</label>
                            </div>
                                <div class="Remember-forgot">
                                    <label>
                                        <input type="checkbox">Se souvenir de moi
                                    </label>
                                <a href="#">Mot de passe oublié?</a>
                                </div>
                                <input type="submit" value="Se connecter" name = "btn_connexion" onclick="cacher_et_afficher('login', 'divPrincipale')" id="btnConnexion">
                                <div class="login-registrer">
                                    <p>Vous n'avez pas encore de compte?
                                <!--     <a href="javascript:void(0);" onclick = "cacher_et_afficher('formConnexion', 'formInscription')">S'inscrire</a>            
                -->                  <a href="#" class="registerLink">S'inscrire</a>

                                    </p>

                                </div>
                            </div>
    </form>
    <form id ="formInscription" class="form_inscription">
                        <div class="container">
                                    <h2>Inscription</h2>
                                    <div class="input-box">
                                        <input type="text" name="username" autocomplete = "off" required >
                                        <label for="username">Nom d'utilisateur</label>
                                </div>
                                <div class="input-box">
                                        <input type="email" name="email_inscription" pattern=".+@gmail\.com" autocomplete = "off" required >
                                        <label for="email">Email</label>
                                </div>
                                <div class="input-box">
                                        <input type="text" name="mdp_inscription" autocomplete = "off" required >
                                        <label for="mdp_inscription">Mot de passe</label>
                                </div>
                                    <div class="terms-conditions">
                                        <label>
                                            <input type="checkbox">J'accepte les termes et les conditions
                                        </label>
                                    </div>
                                    <input type="submit" value="S'inscrire" name = "btn_inscription" id="btnInscription">
                                    <div class="login-registrer">
                                        <p>Vous avez déjà un compte?
                                        <!-- <a href="javascript:void(0);" onclick = "cacher_et_afficher('formInscription', 'formConnexion')">Se connecter</a>            
                    -->                     <a href="#" class="loginLink">Se connecter</a>
                                        </p>
                                    </div>
                                </div>
    </form>
    </div>

     <div id="divPrincipale">
         <section class="sectionMenus">
              <div class="barMenuVerticale">
                 <h4>Nationwide Cargo Connect</h4>
                 <img src="./images/truck.png" alt="Icône" class="icon">
                    <ul class="listeMenus">
                        <li><button type="submit" onclick="cacher_et_afficher_conteneur('conteneurEnvoi')">Envoyer</button></li>
                        <li><button type="submit" onclick="cacher_et_afficher_conteneur('recevoirColis')">Recevoir</button></li>
                        <li><button type="submit" onclick="cacher_et_afficher_conteneur('idModification')">Historique</button></li>
                    </ul>
                    <div class="recetteContainer">
                        <h3 class="recetteTexte">Recette totale accumulée : </h3>
                        <h2 class="recetteValue" id="recette">xxxx</h2>
                    </div>
             </div>
         </section>

        <section class="contenu">
            <div class="envoiyerColis" >

                <nav class="navEnvoi">
                    <h2>Envoyez vos colis n'importe où à Madagascar.</h2>
                    <h6>Veuillez remplir les informations suivantes:</h6>
                </nav>
                <nav class="navHistorique" >
                    
                    <section class="findByDatesClass" >
                        <input type="datetime-local" class="rechercheDate1" id="date1" title="Recherche de colis entre deux dates">
                        <input type="datetime-local" class="rechercheDate2" id="date2" title="Recherche de colis entre deux dates">
                        <button class="findBetween2Dates" onclick="findBetweenDates()">OK</button>
                    </section>

                    <section class="findByDesignClass">
                        <input id="codeOrDesignation" type="text" class="rechercheDesignationCode" placeholder="ID ou Designation" title="Code d'envoi ou Designation">
                        <button class="myBackButton" onclick="cacher_et_afficher_conteneur('idModification')">Back</button>
                        <button class="findByDesignationCode" onclick="findByCodeDesignation()">OK</button>
                    </section>
                </nav>

             <div id="conteneurEnvoi">
                <div class="formulaireEnvoyeur" id="firstFormSender">

                    <form action="" >

                    <article class="inputLeft">
                        <label for="nomEnvoyeur">Nom de l'éxpéditeur</label>    
                        <input type="text" name="nomEnvoyeur" id="senderName">
                        <label for="nomRecpeteur">Nom du destinataire</label>    
                        <input type="text" name="nomRecpeteur" id="receveirName">
                        <label for="colis">Colis</label>    
                        <input type="text" name="colis" id="colisName">
                        <label for="dateEnvoi">Date d'envoie</label>
                        <input type="datetime-local" name="dateEnvoi" id="sendDate">
                    </article>
                    <article class="inputRight">
                        <label for="emailEnvoyeur">Email de l'éxpéditeur</label>    
                        <input type="text" name="emailEnvoyeur" id="senderEmail">
                        <label for="contactRecpeteur">Contact du destinataire</label>    
                        <input type="text" name="contactRecpeteur" id="receveirContact">
                        <label for="frais">Frais</label>    
                        <input type="number" name="frais" id="price" >


                        


                    </article>
                    
                    <button type="button" class="buttonEnvoi" onclick="addClient()">Suivant</button>
                    <button type="reset" class="buttonClear"></button>

                    </form>
                    
                </div>
                <div class="secondFormulaireEnvoyeur" id ="secondFormSender">
                    <form class="inputItineraire" >
                       
                       <label for="selectVoiture">Choix de l'itinéraire</label><br> <br>
                        <select name="selectVoiture" id="selectOption" >
                          
                        </select> <br> <br>
                        <label for="villeDep">Ville de départ</label>
                        <input type="text" name="villeDep" id="departureCity" > <br> <br>
                        <label for="villeArriv">Ville d'arrivée</label>
                        <input type="text" name="villeArriv" id="arrivalCity" > <br> <br>

                        <button type="submit" class="buttonTerminerEnvoi" onclick="addItinerary()">Générer un ticket</button>
                        <button type="reset" class="buttonClear2"></button>
                    </form>      
                </div>
        
            </div>   

                <div class="receptionColis" id="recevoirColis">
                    <div class="receptionColisGauche">
                        <label for="rechercheEnvoyeur">Entrez le numéro du ticket ou l' adresse Email de l'envoyeur :</label>
                        <input type="text" name="rechercheEnvoyeur" id="emailToFind"><br><br>
                        <button type="submit" class="buttonTrouver" onclick="sendEmail2Php()">Trouver</button>
                    </div>
                    <div class="receptionColisDroite">
                        <form action="#">
                            <p class="classNom">Envoyeur :</p> <br>
                            <p class="classEmail">Email :</p>  <br>
                            <p class="classColis">Colis :</p>  <br>
    
                            <p class="classFrais">Frais :</p> <br>

                            <button type="submit" class="buttonReception" onclick="sendEmailToSender()">Envoyer un email</button>
                        </form>
                    </div>
                </div>

                <div class="classModification" id="idModification">
                    <table id="arrayModification">
                        <thead>
                            <th class="senderId">N°</th>
                            <th>Nom de l'envoyeur</th>
                            <th>Email</th>
                            <th>Colis</th>
                            <th class="tableButton">M</th>
                            <th class="tableButton">S</th>
                        </thead>
                        <tbody id="idTable">
                           
                            
                        </tbody>
                    </table>
                    <table id="resultByDesign">
                        <thead class="theadDesign">
                        <th class="senderId">N°</th>
                            <th>Nom de l'envoyeur</th>
                            <th>Email</th>
                            <th>Colis</th>
                            <th class="tableButton">M</th>
                            <th class="tableButton">S</th>
                        </thead>
                        <tbody id="idTableDesign">
                           
                            
                        </tbody>
                    </table>
                    <table id="resultByDates">
                        <thead class="theadDesign">
                        <th class="senderId">N°</th>
                            <th>Nom de l'envoyeur</th>
                            <th>Email</th>
                            <th>Colis</th>
                            <th class="tableButton">M</th>
                            <th class="tableButton">S</th>
                        </thead>
                        <tbody id="idTableDates">
                           
                            
                        </tbody>
                    </table>
                    
                    <div class="formulaireModif" id="formulaireUpdate">
                        <form action="" class="formModif">
                          <button type="button" class="closeButton" onclick="closeUpdateWindow()"></button>
                            <section class="modifLeft">
                                <label for="senderName">Nom de l'envoyeur</label><br>
                                <input type="text" name="senderName" class="senderNameModif"> <br> <br>
                                <label for="senderEmail">Email</label><br> 
                                <input type="text" name="senderEmail" class="senderEmailModif"> <br> <br>
                                <label for="senderColis">Colis</label><br> 
                                <input type="text" name="senderColis" class="senderColisModif"><br> <br>
                                <label for="sendDate">Date d'envoie</label><br>                            
                                <input type="datetime-local" name="sendDate" class="senderDateModif">
                            </section>
                            <section class="modifRight">
                                <label for="receveirName">Nom du destinataire</label><br>
                                <input type="text" name="receveirName" class="receveirNameModif"> <br> <br>
                                <label for="receiveirContact">Contact du destinataire</label><br> 
                                <input type="text" name="receiveirContact" class="receveirContactModif"> <br> <br>
                                <label for="colisFrais">Frais</label><br> 
                                <input type="text" name="colisFrais" class="colisFraisModif"><br> 
                                                       
                            </section>
                            
                           
                        </form>
                        <button type="reset" class="clearButtonModif" onclick="resetFormUpdate()"></button>
                        <button type="submit" class="saveButton" onclick="saveUpdate()" id="saveUpdateButton">Enregistrer</button>
                    </div>

                </div>
           </div> 
        </section>
    </div>

     
      
    <script src="./Js/script.js"></script>    
</body>
</html>