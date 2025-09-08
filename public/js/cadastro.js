function slide(){
    const element6 = document.getElementById("transform")
    if(element6.classList == "formside"){
        element6.classList = "formsider";
    }else{
        element6.classList = "formside";
    }

    const element7 = document.getElementById("translogo")
    if(element7.classList == "logoside"){
        element7.classList = "logosidel";
    }else{
        element7.classList = "logoside";
    }
    
    const element8 = document.getElementById("transresp")    
    element8.classList = "transresp2";
    setTimeout(function(){
        element8.classList = "transresp1";
    }, 375);

    setTimeout(function(){
        const element = document.getElementById("formtit")
        if(element.textContent == "CRIAR CONTA"){
            element.textContent = "LOGIN";
        }else{
            element.textContent = "CRIAR CONTA";
        }

        const element2 = document.getElementById("botaologincadastrar")
        if(element2.value == "Cadastrar"){
            element2.value = "Entrar";
        }else{
            element2.value = "Cadastrar";
        }

        const element3 = document.getElementById("linklogin")
        if(element3.textContent == "Não tem cadastro? "){
            element3.textContent = "Já fez cadastro? ";
        }else{
            element3.textContent = "Não tem cadastro? ";
        }

        const element4 = document.getElementById("linklogin2")
        if(element4.textContent == "Fazer Login"){
            element4.textContent = "Cadastrar";
        }else{
            element4.textContent = "Fazer Login";
        }
        
        const element5 = document.getElementById("conf")
        if(element5.classList == "conf"){
            element5.classList = "conf2";
        }else{
            element5.classList = "conf";
        }
    }, 375);
}
function mostrarsenha(){
    const mostsenha = document.getElementById("most1");
    if(mostsenha.type == "password"){
        mostsenha.type = "text";
    }
    else{
        mostsenha.type = "password";
    }
}
function mostrarconfirm(){
    const mostconfirm = document.getElementById("most2");
    if(mostconfirm.type == "password"){
        mostconfirm.type = "text";
    }
    else{
        mostconfirm.type = "password";
    }
}