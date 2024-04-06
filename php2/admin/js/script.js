function neueZutat(){
    // holt die divs "zutatenliste" und "zutatenblock" aus dem HTML
    var block = document.querySelector(".zutatenliste .zutatenblock"); // clont die div.class= zutatenliste > Zutatenblock

    var neuer_block = block.cloneNode(true); //Teil wird kopiert und unten angehängt
    document.querySelector(".zutatenliste").appendChild(neuer_block);

    neuer_block.querySelector("select").value = "";
}