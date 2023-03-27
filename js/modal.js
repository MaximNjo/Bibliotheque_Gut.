// script la modal

 $("a[data-suppression]").click(function(){

    let message = $(this).attr("data-message");
    let lien = $(this).attr("data-suppression");
    $("#btn").attr("href", lien);
    $('.modal-body').text(message);
    
});


// script liste nationalité

// document.getElementById('formRecherche').submit();


const continentSelect = document.querySelector('select[name="continent"]');

continentSelect.addEventListener('change', function() {
  const continentNum = continentSelect.value;
  performSearch(continentNum);
});

function performSearch(continentNum) {
  // Code to perform search using the selected continent number
  // For example, you could send an AJAX request to a server
  // and display the search results on the page
}
