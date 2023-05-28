function jsonCheckMail(json) {
    // Controllo il campo exists ritornato dal JSON
    if (formStatus.username = !json.exists) {
        document.querySelector('.mail').classList.remove('error');
    } else {
        let text = document.createElement('div').textContent = "Mail Già Registrata";
        document.querySelector('.mail').appendChild(text);
        
        document.querySelector('.mail').classList.add('error');
    }
    checkForm();
}

function jsonCheckTelefono(json) {
    // Controllo il campo exists ritornato dal JSON
    if (formStatus.telefono = !json.exists) {
        document.querySelector('.telefono').classList.remove('error');
    } else {
        let text = document.createElement('div').textContent = "Telefono Già Registrato";
        document.querySelector('.telefono').appendChild(text);
        
        document.querySelector('.telefono').classList.add('error');
    }
    checkForm();
}



function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}


function checkMail(event) {
    const input = document.querySelector('.mail input');
    
  
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value)){
            if(!document.querySelector('.mail').classList.contains('error')){
                let text = document.createElement('div');
                text.textContent = "mail Non Valida";
                document.querySelector('.mail').appendChild(text);
                document.querySelector('.mail').classList.add('error');
            }

            formStatus.username = false;
            checkForm();
        } else {
            let text = document.querySelector('.mail div')
            text.textContent = '';
            document.querySelector('.mail').classList.remove('error');
            document.querySelector('.mail').removeChild(text);
            fetch("check_mail.php?q=" + encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckMail);
        }


    }
   
    function checkTelefono(event) {
        const input = document.querySelector('.telefono input');
        
      
        if (!/^\d{10}$/.test(input.value)){
                if(!document.querySelector('.telefono').classList.contains('error')){
                    if(!document.querySelector('.telefono').classList.contains('error')){
                        let text = document.createElement('div');
                        text.textContent = "Telefono Non Valido";
                        document.querySelector('.telefono').appendChild(text);
                        document.querySelector('.telefono').classList.add('error');
                    }
        
                    formStatus.username = false;
                    checkForm();
                } else {
                    let text = document.querySelector('.telefono div')
                    text.textContent = '';
                    document.querySelector('.telefono').classList.remove('error');
                    document.querySelector('.telefono').removeChild(text);
                    fetch("check_telefono.php?q=" + encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckTelefono);
                }
    
    
        }
    }
       
        function checkForm() {
        
            // Controlla che tutti i campi siano pieni
            Object.keys(formStatus).length !== 2 ||
            // Controlla che i campi non siano false
             Object.values(formStatus).includes(false);
    }


document.querySelector('.mail input').addEventListener('blur', checkMail);
document.querySelector('.telefono input').addEventListener('blur', checkTelefono);

if (document.querySelector('.error') !== null) {
    checkMail(); 
    checkTelefono(); 
    document.querySelector('.mail input').dispatchEvent(new Event('blur'));
    document.querySelector('.telefono input').dispatchEvent(new Event('blur'));
}