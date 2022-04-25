function urlSite()
{//Retourne sans '/' à la fin. Ici, http...Projet-fil-rouge
    let temp = window.location.href.split(window.location.origin);
    temp = temp[1];
    temp = temp.split('/');
    let url = window.location.origin;
    let racine = "projet-fil-rouge";
    for (let i = 0; i < temp.length; i++) {
        url = url+"/"+temp[i];
        if (temp[i] == racine)
        {
            return url;
        }
    }
    return url;
}

function menuToDisplay()
{
    let logo = document.querySelector('#logo-vape-shop');
    let menu = document.querySelector('#menu');
    url = urlSite();
    if (screen.width > 800)
    {
        if(window.scrollY == 0)
        {
            logo.setAttribute("src",url+"/public/images/vape_shop_logo.png");
            menu.classList.add("my-menu");
            menu.classList.remove("my-menu2");
        }
        if (window.scrollY >= 1)
        {
            logo.setAttribute("src",url+"/public/images/vape_shop_logo2.png");
            menu.classList.add("my-menu2");
            menu.classList.remove("my-menu");
        }
    }
}
document.addEventListener("scroll",()=>{
    menuToDisplay();
});



let iconePanier = document.querySelector('.icone-panier');
let panier = document.querySelector('.panier');
function togglePanier(e)
{
    //e.preventDefault();
    panier.style.zIndex = 5;
    panier.classList.toggle("off");
    panier.classList.toggle("on");
}
if ((typeof iconePanier !== 'undefined') && (iconePanier !== null)) {
    iconePanier.addEventListener("click",()=>{
        togglePanier();
    });
}
if ((typeof panier !== 'undefined') && (panier !== null)) {
    panier.addEventListener("click",()=>{
        togglePanier();
    });
}





let selectParfum = document.querySelector('#selectParfum');
function changementProduit()
{
    let cheminImageProduit = document.querySelector('#image-produit');
    let prixProduit = document.querySelector('#prix-produit');
    let url = urlSite()+'/api/infoProduit/'+selectParfum.value;
    fetch(url,{
          headers: {
          'Content-Type': 'application/json;charset=UTF-8',
          "Access-Control-Allow-Origin": "*",
      }})
    .then(response => response.json())
    .catch(error => alert("Erreur : " + error))
    .then(data =>
        {
            cheminImageProduit.setAttribute('src',data[0].chemin_image_produit);
            prixProduit.innerHTML= data[0].prix_produit+' €';
        }
    );
}
if ((typeof selectParfum !== 'undefined') && (selectParfum !== null)) {
    selectParfum.addEventListener("click",()=>{
        changementProduit();
    });
}



let deleteAddressButton = document.querySelectorAll('.supprimer-adresse');
deleteAddressButton.forEach((item, index, arr) => {
  //arr[index] = item * 10;
  arr[index].addEventListener("click",(e)=>{
    if (confirm("Voulez vous vraiment supprimer cette adresse ?") == true) {
        let url = urlSite()+'/compte/suppressionAdresse/'+e.target.value;
        document.location.href=url;
    }
});
});

let deleteAccountButton = document.querySelectorAll('.supprimer-compte');
deleteAccountButton.forEach((item, index, arr) => {
  //arr[index] = item * 10;
  arr[index].addEventListener("click",(e)=>{
    if (confirm("Voulez vous vraiment supprimer votre compte ?") == true) {
        let url = urlSite()+'/compte/suppressionCompte/'+e.target.value;
        document.location.href=url;
    }
});
});

let deleteProductButton = document.querySelectorAll('.button-supprimer-produit');
deleteProductButton.forEach((item, index, arr) => {
  //arr[index] = item * 10;
  arr[index].addEventListener("click",(e)=>{
deleteProduct(e);
});
});
function deleteProduct (e)
{
    if (confirm("Voulez vous vraiment supprimer le produit ?") == true) {
        let url = urlSite()+'/api/suppressionProduit/'+e.target.value;
        fetch(url,{
          headers: {
          'Content-Type': 'application/json;charset=UTF-8',
          "Access-Control-Allow-Origin": "*",
        }})
        .then(
            //response => response.json()
        )
        .catch(error => alert("Erreur : " + error))
        .then(data =>
        {
            if (data)
            {
                document.querySelector('#produit'+e.target.value).remove();
            }
            else{
                alert("La suppression n'a pas pu être effectuée !");
            }
        }
    );
    }
}



// let updateButton = document.querySelectorAll('.button-modifier-produit');
// updateButton.forEach((item, index, arr) => {
//   //arr[index] = item * 10;
//   arr[index].addEventListener("click",(e)=>{
//     // e.target.parentElement.parentElement.nextElementSibling.innerText = "test avec un long texte d'erreur de la mort qui tue";
//     // let parfum = e.target.parentElement.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.childNodes[3].value;
//     // let prix = e.target.parentElement.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.childNodes[3].value;
//     // let quantite = e.target.parentElement.parentElement.parentElement.previousElementSibling.previousElementSibling.childNodes[3].value;
//     // let image = e.target.parentElement.parentElement.parentElement.previousElementSibling.childNodes[3].value;
//     // console.log(e);
//         if (confirm("Voulez vous vraiment modifier le produit ?") == true) {
//             let url = urlSite()+'/api/modifierProduit/'+e.target.value;
//         };
//     });
// });


















