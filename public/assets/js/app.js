//código colocado dentro de uma função auto-invocada pra tirar do escopo global
(function () {
  const menuToggle = document.querySelector(".menu-toggle");
  menuToggle.onclick = function (e) {
    const body = document.querySelector("body");
    //vai adicionar ou remover a classe hide do body
    body.classList.toggle("hide-sidebar");
  };
})();
