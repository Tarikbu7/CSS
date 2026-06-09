/* ==========================================================================
   1. PORTÉE (SCOPE) ET FONCTIONS IMBRIQUÉES
   ========================================================================== */

// Une variable globale est accessible partout
const nomGlobal = "Apollo"; 

function Planete() {
  // Variable locale à la fonction Planete (Portée de fonction)
  const nomPlanete = "Terre"; 

  function Ville() {
    // Variable locale à la fonction Ville
    const nomVille = "Paris"; 
    
    // Une fonction imbriquée a accès aux variables de ses parents !
    // C'est ce qu'on appelle la "Lexical Scope" (Portée Lexicale)
    const message = `Id : ${nomGlobal} | Lieu : ${nomVille}, ${nomPlanete}`;
    return message;
  }

  // Si on essayait de faire un console.log(nomVille) ici -> Erreur ! 
  // Le parent ne peut pas voir à l'intérieur de ses enfants.

  return Ville(); // On exécute et renvoie le résultat de la fonction interne
}

// Affichage du résultat dans l'HTML
document.getElementById('scope-output').innerText = Planete();


/* ==========================================================================
   2. LES FONCTIONS CALLBACKS
   ========================================================================== */

/**
 * Un "Callback" est une fonction passée en argument à une autre fonction, 
 * pour être exécutée plus tard (souvent après une action asynchrone).
 */

// 1. On crée la fonction qui va recevoir le callback
function telechargerFichier(nomFichier, fonctionAExecuterApres) {
  console.log(`Début du téléchargement de : ${nomFichier}...`);
  
  // On simule une attente de 2 secondes (asynchrone)
  setTimeout(function() {
    console.log("Téléchargement terminé !");
    
    // Le téléchargement est fini, on appelle le "callback"
    const messageSucces = `Le fichier "${nomFichier}" est prêt.`;
    fonctionAExecuterApres(messageSucces); 
    
  }, 2000);
}

// 2. On crée la fonction callback elle-même
function afficherDansPage(resultat) {
  document.getElementById('callback-output').innerText = resultat;
}

// 3. On appelle la fonction principale en lui PASSANT la fonction de callback
// Attention : on écrit 'afficherDansPage' SANS parenthèses, sinon elle s'exécuterait tout de suite !
telechargerFichier("cours_javascript.pdf", afficherDansPage);