function slide(){
    const element = document.getElementById("formtit")
    if(element.textContent == "CRIAR CONTA"){
        element.textContent = "ENTRAR";
    }else{
        element.textContent = "CRIAR CONTA";
    }

    const element2 = document.getElementById("logotit")
    if(element2.textContent == "SEJA BEM VINDO(A)!"){
        element2.textContent = "BEM VINDO(A) DE VOLTA!";
    }else{
        element2.textContent = "SEJA BEM VINDO(A)!";
    }
    
    
}