function Products(id, naslov, dostupneVelicine,cijenaUKN,slika1,slika2) { // Class as a function
    this.id = id;
    this.naslov = naslov;
    this.dostupneVelicine = dostupneVelicine;
    this.cijenaUKN = cijenaUKN;
    this.slika1 = slika1;
    if(slika2 != null){
        this.slika2 = slika2;
    }
}