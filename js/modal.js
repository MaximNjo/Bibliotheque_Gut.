// script la modal

 $("a[data-suppression]").click(function(){

    let message = $(this).attr("data-message");
    let lien = $(this).attr("data-suppression");
    $("#btn").attr("href", lien);
    $('.modal-body').text(message);
    
});


// script liste nationalité
<<<<<<< HEAD
// document.getElementById('formRecherche').submit()
=======

// let yop = document.getElementById("libelle");
// let formRecherche = document.getElementById("formRecherche");

// yop.addEventListener("input", function() {

//   formRecherche.submit();

// });
>>>>>>> 98a6cc53adbcd05d0974aba4a0d5103e787df0c8
