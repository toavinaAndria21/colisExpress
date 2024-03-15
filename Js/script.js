writeRecette();
itineraryOptions();

function cacher_et_afficher(idFormACacher, idFormAAfficher)
    {
        if (idFormACacher == 'login' && idFormAAfficher == 'divPrincipale')
        {
           
            document.getElementById('divPrincipale').style.display = 'none';
            connexionAnswer();
        }
        else
        {
            document.getElementById(idFormACacher).style.display = 'none';
            document.getElementById(idFormAAfficher).style.display = 'block';
        }
    }

async function connexionAnswer()
    {
            let infoManager = [document.getElementById('email_input').value, document.getElementById('mdp_input').value];

           
            await fetch('../managerLogin.php',{
            method : "POST",
            headers : {"Content-Type":"application/json"},
            body : JSON.stringify(infoManager) 
                    })
            .then(reponse => reponse.text())
            .then(data=>{ 
               
                alert("data: "+data);
                if(data == 'true')
                {
                    document.getElementById('divPrincipale').style.display = 'block';
                    document.getElementById('login').style.display = 'none';
                }
                else 
                {
                    document.getElementById('login').style.display = 'block';
                }                
            });       
    }

const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.loginLink');
const registerLink = document.querySelector('.registerLink');

registerLink.addEventListener('click',() => {
    wrapper.classList.add('active');
});

loginLink.addEventListener('click',() => {
    wrapper.classList.remove('active');
});

let value = false;
function cacher_et_afficher_conteneur(idConteneurAAfficher) // reçoi en parametre un id
    {   //affiche et cache les conteneurs de chaque bouttons du bar menus vertical
        

        var tab = [document.getElementById('conteneurEnvoi').id,document.getElementById('recevoirColis').id,document.getElementById('idModification').id];
    
        var i = 0;
        var arraySize = tab.length;
    
        while(i < arraySize)
            { 
                    if (tab[i] == idConteneurAAfficher)
                    {
                        if (idConteneurAAfficher == 'idModification')
                        {
                            document.querySelector('.navEnvoi').style.display = 'none';
                            document.querySelector('.navHistorique').style.display = 'block';
                            if(value === false)
                            {
                                value = true;
                                printSenderDataOnTable();
                                document.querySelector('.myBackButton').style.display = "none";
                            }
                            
                        }
                        else
                        {
                            document.querySelector('.navHistorique').style.display = 'none';
                            document.querySelector('.navEnvoi').style.display = 'block';
                            value = false;
                        }
                        document.getElementById(tab[i]).style.display ='block';           
                    }
                    else
                    {
                        document.getElementById(tab[i]).style.display ='none';  
                    } 

                i++;     
            }
           // showHideArray('arrayModification');  
           
    }


function collecteForm1() //recuperer les valeurs de la premiere formulaire d'enregistrement en cliquant sur SUIVANT
    {
        var arrayForm1 = [ document.getElementById('senderName').value, document.getElementById('receveirName').value, document.getElementById('colisName').value, document.getElementById('sendDate').value.split('/').reverse().join('-'), document.getElementById('senderEmail').value, document.getElementById('receveirContact').value, document.getElementById('price').value, document.getElementById('selectOption').value ];
        
        return arrayForm1;
    }


function addClient()
    {
        
        var arrayFormFinale = collecteForm1();
        
        

    fetch('../addClient.php', {
            method : "POST",
            headers : {"Content-Type":"application/json"},
            body : JSON.stringify(arrayFormFinale) 
                    })
        .then(reponse => reponse.text())
        .then(data=>{
            alert('efa mety eh');
            alert(data);
                    })
        
        cacher_et_afficher('firstFormSender', 'secondFormSender');               
    
    }

async function addItinerary()
    {
        var arrayForm2 = [document.getElementById('codeItineraire').value ,document.getElementById('departureCity').value, document.getElementById('arrivalCity').value ];


        await fetch('../addItineraire.php', {
            method : "POST",
            headers : {"Content-Type":"application/json"},
            body : JSON.stringify(arrayForm2) 
                    })
        .then(reponse => reponse.text())
        .then(data=>{
            alert('e mbola mety eh');
            getEmailFromInput();   
                    })    
                 

    }
/*async function callGenererpdf()
   {   
    await fetch('../genererPdf.php')
   } */   
   
async function getEmailFromInput()
   {
    alert('karakory');
    var email = [document.getElementById('senderEmail').value, document.getElementById('codeItineraire').value];
    alert('ty le email\n' +  email );
    await fetch('../genererPdf.php', {
            method : "POST",
            headers : {"Content-Type":"application/json"},
            body : JSON.stringify(email) 
                    })
       /* .then(reponse => reponse.json())
        .then(data=>{ 

         })    */
   }   
 
async function sendEmail2Php()
    {
      
        var email =[document.getElementById('emailToFind').value];
        alert(email[0]);       
        let nouvelElement = {};
    await fetch('../rechercheEmail.php', {
            method : "POST",
            headers : {"Content-Type":"application/json"},
            body : JSON.stringify(email) 
                    })
        .then(reponse => reponse.json())
        .then(data=>{
           
        
                 
          //  data.forEach(function(element, index) 
          for(key in data)
            {                       
                nouvelElement.nomEnvoyeur = data.nomEnvoyeur;
                nouvelElement.emailEnvoyeur = data.emailEnvoyeur;
                nouvelElement.colis = data.colis;
                nouvelElement.nomRecepteur = data.nomRecepteur;
                nouvelElement.frais = data.frais;

                
            }   
            
            document.querySelector('.classNom').innerHTML = 'Envoyeur :\t' + nouvelElement.nomEnvoyeur;
            document.querySelector('.classEmail').innerHTML = 'Email :\t' + nouvelElement.emailEnvoyeur;
            document.querySelector('.classColis').innerHTML = 'Colis :\t' + nouvelElement.colis;
            document.querySelector('.classFrais').innerHTML = 'Frais :\t' + nouvelElement.frais + '\tAriary';

            
            
       })      
  
    }

var tableau = document.getElementById('arrayModification'); 

async function itineraryOptions()
{
    await fetch('../itineraryOptions.php')
        .then(reponse => reponse.json())
        .then(data=>{   
      
       showOptions('selectOption', data, 'itineraryNumero_');
      
      
     });
}

async function showDestination(IdOfSelect)
    {
        alert('Destination');
        let selectValue = [document.getElementById(IdOfSelect).value];
        let departureCity = document.getElementById('departureCity');
        let arrivalCity = document.getElementById('arrivalCity');

        await fetch('../getDestination.php', {
            method : "POST",
            headers : {"Content-Type":"application/json"},
            body : JSON.stringify(selectValue) 
            })
            .then(reponse => reponse.json())
            .then(data=>{
                  alert('ity le destination:\t' + data);

                  data.forEach(function(element) {
                   
                        departureCity.textContent = element['villeDep'];
                        arrivalCity.textContent = element['villeArr'];
                  })
            });
    }
function showOptions(IdOfSelect, dataFromFetch, idOfOptions)
    {
           
            
            dataFromFetch.forEach(function(element, index)
                {
                    let select = document.getElementById(IdOfSelect);
                    let itinerary = document.createElement('option');

                    itinerary.id = idOfOptions + index;
                    select.appendChild(itinerary);
                    itinerary.textContent = element['codeIt'];
                  

                });

    }

function createArray(dataFromFetch, idTBody, IdEachForLine)
    {
        dataFromFetch.forEach(function(element, index) {
            
                

        var tbody = document.getElementById(idTBody); 
        var newLine = document.createElement('tr'); 
        newLine.id = IdEachForLine + index;
        var newtd0 = document.createElement('td'); 
        var newtd1 = document.createElement('td');
        var newtd2 = document.createElement('td');
        var newtd3 = document.createElement('td');
        var newtd4 = document.createElement('td');
        var newtd5 = document.createElement('td');


        newtd4.style.alignItems = 'center';
        newtd5.style.alignItems = 'center';
        newtd4.style.textAlign = 'center';
        newtd5.style.textAlign = 'center';
        
        newtd0.textContent = element['idEnvoi'];
        newtd1.textContent = element['nomEnvoyeur'];      
        newtd2.textContent = element['emailEnvoyeur']; 
        newtd3.textContent = element['colis'];
        var buttonModif = document.createElement('button');
        var buttonDelete = document.createElement('button');
        buttonModif.textContent = 'Mod';
        buttonDelete.textContent = 'Supp';
    
        buttonDelete.setAttribute("class", "myDeleteButton");
        buttonModif.setAttribute("class", "myUpdateButton");

        //  newtd4.textContent = nouvelElement['date_Envoi'];

        newtd4.appendChild(buttonModif);
        newtd5.appendChild(buttonDelete);
        tbody.appendChild(newLine);
        newLine.appendChild(newtd0);
        newLine.appendChild(newtd1);
        newLine.appendChild(newtd2);
        newLine.appendChild(newtd3);
        newLine.appendChild(newtd4);
        newLine.appendChild(newtd5);
    
     
        if((index % 2) == 0)
            {
            newLine.style.backgroundColor = 'whitesmoke';
            }
        });
    }
   
async function printSenderDataOnTable()
    {
    
        let codeDesignation = [""];
        
            await fetch('../findByCodeDesignation.php', {
                method : "POST",
                headers : {"Content-Type":"application/json"},
                body : JSON.stringify(codeDesignation) 
                })
                .then(reponse => reponse.json())
                .then(data=>{
                  
                    if(i === false)
                    lastDataLength = data.length;

                    if(i === true)
                    {   
                         deleteLinesById("searchResultLine_", lastDataLength);    
                    }
                    
                    createArray(data, 'idTableDesign', 'searchResultLine_');
                    showHideArray('resultByDesign');
                
                    i = true;
                    value = false;
                    lastDataLength = data.length;
                    deleteSenderFromTableModif();
                    getSenderToUpdateFromTableModif();
                });

    }


function removeArrayLine()
  {
    let allLine = document.querySelectorAll('tbody tr');
    allLine.removeChild();
  }

async function sendEmailToSender()
  {
   
    await fetch('../Email.php')
     
  }

function deleteArrayLine(button){
     //supprime les données de la ligne dont le bouton supprimé est cliqué
    let tr = button.parentNode.parentNode;
    let tbody = tr.parentNode;

    tbody.removeChild(tr);
}
function reloadPage()
   {
    window.location.reload(false);
    alert("Page rechargéé");
   }

 async function deleteSenderFromTableModif()  
  {
     
    let senderId;
    let nodeListDeleteButton = document.querySelectorAll('.myDeleteButton');
  

     nodeListDeleteButton.forEach(button => {

        button.addEventListener('click', function(){
           
            let line = this.parentNode.parentNode;
            senderId = [line.cells[0].innerText];
           
          
            
             fetch('../deleteSender.php', {
                method : "POST",
                headers : {"Content-Type":"application/json"},
                body : JSON.stringify(senderId) 
                        }) 
                        deleteArrayLine(button);        
                                             
             }) 
       });
   // let senderId = document.getElementById('').value; //mbolq tsy vita  
  }

  let senderId;
  let idDelaLigneAModifier;
async function getSenderToUpdateFromTableModif()
   {
   
    let nouvelElement = {};
    let nodeListUpdateButton = document.querySelectorAll('.myUpdateButton');
    let dateSQL;
    let formattedDate;
  
    nodeListUpdateButton.forEach(button => {

        button.addEventListener('click', function(){
           
            let line = this.parentNode.parentNode;
          
            senderId = [line.cells[0].innerText];
            idDelaLigneAModifier = line.id;
            
            document.getElementById('formulaireUpdate').style.display = 'block';

            
            
             fetch('../getSenderToUpdate.php', {
                method : "POST",
                headers : {"Content-Type":"application/json"},
                body : JSON.stringify(senderId) 
            
                                              })
            .then(reponse => reponse.json())
            .then(data=>{ 
               
                data.forEach(element=>
                  {            
                    nouvelElement.nomEnvoyeur = element.nomEnvoyeur;
                    nouvelElement.emailEnvoyeur = element.emailEnvoyeur;
                    nouvelElement.colis = element.colis;
                    nouvelElement.date_Envoi = element.date_Envoi;
                    nouvelElement.nomRecepteur = element.nomRecepteur;
                    nouvelElement.contactRecepteur = element.contactRecepteur;
                    nouvelElement.frais = element.frais;

                    dateSQL = element.date_Envoi;
                    let dateJS = new Date(dateSQL); 
                    //Formattage de la date SQL pour le rendre compatible avec l'input datetime-local en html
                    formattedDate = dateJS.toISOString().slice(0, 16);

                  })
                
                 
                document.querySelector('.senderNameModif').value = nouvelElement.nomEnvoyeur;
                document.querySelector('.senderEmailModif').value = nouvelElement.emailEnvoyeur;
                document.querySelector('.senderColisModif').value = nouvelElement.colis;
                document.querySelector('.senderDateModif').value = formattedDate;
                document.querySelector('.receveirNameModif').value = nouvelElement.nomRecepteur;
                document.querySelector('.receveirContactModif').value = nouvelElement.contactRecepteur;
                document.querySelector('.colisFraisModif').value = nouvelElement.frais;
 
                   })     
               })

           });
           
   }
   var lastDataLength = 0;
   var i = false;
async function findByCodeDesignation()
{
    document.querySelector('.myBackButton').style.display = "block";
    let codeDesignation = [document.getElementById('codeOrDesignation').value];
    
            if(codeDesignation[0] === "")
            {
                codeDesignation[0] = "#A";
            }
            await fetch('../findByCodeDesignation.php', {
                method : "POST",
                headers : {"Content-Type":"application/json"},
                body : JSON.stringify(codeDesignation) 
                })
                .then(reponse => reponse.json())
                .then(data=>{
                  
                    if(i === false)
                    lastDataLength = data.length;

                    if(i === true && value === false)
                    {   
                        deleteLinesById("searchResultLine_", lastDataLength);   
                    }
                    
                    createArray(data, 'idTableDesign', 'searchResultLine_');
                    showHideArray('resultByDesign');
                
                    i = true;
                    value = false;
                    lastDataLength = data.length;
                    deleteSenderFromTableModif();
                    getSenderToUpdateFromTableModif();
                });           
     
}

function deleteLinesById(idOfLine,numberOfLines)
{       
        let j=0;

        while(j<numberOfLines)
        {
            document.getElementById(idOfLine+j).remove();
            j += 1;
        }
}
var value3 = false;
var lastDataDatesLenth;
async function findBetweenDates()
{
    document.querySelector('.myBackButton').style.display = "block";
    let inputDates = [document.getElementById('date1').value.split('/').reverse().join('-'), document.getElementById('date2').value.split('/').reverse().join('-')];

                if(value3 === true)
                {
                    deleteLinesById("searchDatesResultLine_", lastDataDatesLenth);
                    value3 = false;
                }

                if (inputDates[0] === "" && inputDates[1] === "")
                {
                    inputDates[0] ="#A";
                    inputDates[1] ="#A";
                }

                fetch('../findBetweenDates.php', {
                    method : "POST",
                    headers : {"Content-Type":"application/json"},
                    body : JSON.stringify(inputDates) 
                    })
                    .then(reponse => reponse.json())
                    .then(data=>{

                        if(value3 === false) 
                        {
                            value3 = true;
                            value = false;
                            lastDataDatesLenth = data.length; //
                            showHideArray('resultByDates');
                            createArray(data, 'idTableDates', 'searchDatesResultLine_');
                        }

                        deleteSenderFromTableModif();
                        getSenderToUpdateFromTableModif();
                    });
}
function showHideArray(arrayIdToShow)
{
   let arrayList = ['arrayModification', 'resultByDesign', 'resultByDates'];
   let i =0;
   while(i < arrayList.length)
      {
          if(arrayList[i] == arrayIdToShow)
            {   
                document.getElementById(arrayList[i]).style.display = 'block';
            }
           else
           {
                document.getElementById(arrayList[i]).style.display = 'none';
           }
        i++;   
      }
}

async function writeRecette()
{
    fetch('../recetteTotale.php')
        .then(reponse => reponse.text())
        .then(data=>{

            document.getElementById('recette').textContent = data.toString() + "\tAr";
         });
}
let column2update;
async function saveUpdate() 
{
    
  
    senderId = parseInt(senderId);
    
    let newUpdateArray = [senderId, document.querySelector('.senderNameModif').value, document.querySelector('.receveirNameModif').value,document.querySelector('.senderColisModif').value, document.querySelector('.senderDateModif').value.split('/').reverse().join('-'), document.querySelector('.senderEmailModif').value, document.querySelector('.receveirContactModif').value, document.querySelector('.colisFraisModif').value];

     column2update = [document.querySelector('.senderNameModif').value, document.querySelector('.senderEmailModif').value, document.querySelector('.senderColisModif').value];
    
    

            await fetch('../updateSender.php', {
                method : "POST",
                headers : {"Content-Type":"application/json"},
                body : JSON.stringify(newUpdateArray) 
            
            })
            .then(reponse => reponse.text())
            .then(data=>{    
                
              //  document.getElementById('saveUpdateButton').innerHTML = data;     
                document.getElementById('formulaireUpdate').style.display='none';
                updateArrayLine(idDelaLigneAModifier, column2update);
               
           
            })    

}

function updateArrayLine(lineId, newData)
 {
    
    let line = document.getElementById(lineId);

    line.cells[1].textContent = newData[0];
    line.cells[2].textContent = newData[1];
    line.cells[3].textContent = newData[2];

   
 }
function closeUpdateWindow()
{
     document.getElementById('formulaireUpdate').style.display='none';
     document.getElementById('idModification').style.display='block';
}
function resetFormUpdate()
 {
    
    document.querySelector('.senderNameModif').value = '';
    document.querySelector('.senderEmailModif').value = '';
    document.querySelector('.senderColisModif').value = '';
    document.querySelector('.senderDateModif').value = '';
    document.querySelector('.receveirNameModif').value = '';
    document.querySelector('.receveirContactModif').value = '';
    document.querySelector('.colisFraisModif').value = '';
    
 }