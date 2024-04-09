//Make accounts toggle visibility
document.getElementById("acc-click").onclick = () => {
  if (document.getElementById("acc-lists").style.display == "block") {
    document.getElementById("acc-lists").style.display = "none";
  } else document.getElementById("acc-lists").style.display = "block";
  document.getElementById("acc-click").classList.toggle("clicked");
};
//Move the img of card when hovering the card
document.querySelectorAll(".container .prod-cards .card").forEach((e) => {
  e.onmouseenter = () => {
    e.querySelectorAll(".container .prod-cards .card .up-img img").forEach(
      (img) => {
        img.style.transform = "scale(1.05)";
      }
    );
  };
  e.onmouseleave = () => {
    e.querySelectorAll(".container .prod-cards .card .up-img img").forEach(
      (img) => {
        img.style.transform = "scale(1)";
      }
    );
  };
});

  //AJAX ---------------------- >>>
  
if (document.querySelector(".cart-logo") != null) {
  // Adiciona um ouvinte de evento de clique ao logo do carrinho.
  document.querySelector(".cart-logo").onclick = () => {
    // Quando o logo do carrinho é clicado, a classe "displayed" é alternada.
    // Isso normalmente mostra ou esconde o carrinho na interface do usuário.
    document.querySelector(".cart").classList.toggle("displayed");

    // Inicia uma nova solicitação AJAX para buscar os dados do carrinho do usuário.
    var xhr = new XMLHttpRequest(); // Cria um novo objeto XMLHttpRequest.
    xhr.open("GET", "viewcart.php", true); // Configura a solicitação como uma operação "GET" para o arquivo "viewcart.php". O terceiro parâmetro `true` indica que a solicitação será assíncrona.

    xhr.onload = function () {
      if (this.status == 200) {
        // Se a solicitação for bem-sucedida, atualiza o conteúdo do elemento com id "items" com a resposta recebida.
        // Esta resposta é esperada ser o conteúdo HTML dos itens no carrinho do usuário, gerado pelo "viewcart.php".
        document.getElementById("items").innerHTML = this.responseText;
      }
    };

    xhr.send();
  };
}


//Seacrh by category and brand validation
document.forms[0].onsubmit = () => {
  catValue = document.getElementById("category").value;
  brandValue = document.getElementById("brand").value;
  if (catValue == "0" || brandValue == "0") {
    document.getElementById("wrongSearch").innerHTML =
      "Please select a brand and a category to search for.";
    setTimeout(() => {
      document.getElementById("wrongSearch").innerHTML = "";
    }, 3000);
    return false;
  }
};
