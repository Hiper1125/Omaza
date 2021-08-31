//Funzione per effettuare le transizione
window.addEventListener("beforeunload", function () {
  document.body.classList.remove("animte-in");
  document.body.classList.add("animate-out");
});