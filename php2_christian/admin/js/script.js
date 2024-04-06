function neueZutat() {
    var block = document.querySelector(".zutatenliste .zutatenblock");
    var neuer_block = block.cloneNode(true);
    document.querySelector(".zutatenliste").appendChild(neuer_block);

    neuer_block.querySelector("select").value = "";

}