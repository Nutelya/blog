testElt = document.getElementById('get-data-form');
testElt.addEventListener("submit", function (e) {
  aideElt = document.getElementById('aideContenu');
  textElt = document.getElementsByName('contenu');
  if (textElt.textContent === 0) {
    aideElt.textContent = "Le billet est vide";
    e.preventDefault();
  }
});
