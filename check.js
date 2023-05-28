// JavaScript source code
function checkCodfisc(event) {
    const input = event.currentTarget;

    
    if (!/^(?:[A-Z][AEIOU][AEIOUX]|[B-DF-HJ-NP-TV-Z]{2}[A-Z]){2}(?:[\dLMNP-V]{2}(?:[A-EHLMPR-T](?:[04LQ][1-9MNP-V]|[15MR][\dLMNP-V]|[26NS][0-8LMNP-U])|[DHPS][37PT][0L]|[ACELMRT][37PT][01LM]|[AC-EHLMPR-T][26NS][9V])|(?:[02468LNQSU][048LQU]|[13579MPRTV][26NS])B[26NS][9V])(?:[A-MZ][1-9MNP-V][\dLMNP-V]{2}|[A-M][0L](?:[1-9MNP-V][\dLMNP-V]|[0L][1-9MNP-V]))[A-Z]$"."/i.test(input.value))
    {
        let text = document.createElement('span').textContent = "Sono ammesse lettere e numeri . 16 caratteri";
        document.querySelector('.codfisc').appendChild(text);
        document.querySelector('.codfisc').classList.add('error');
        formStatus.codfisc = false;
        checkForm();
} else {
    fetch("Check_codfisc.php?q=" + encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckCodfisc);
}
}


function jsonCheckCodfisc(json) {
    // Controllo il campo exists ritornato dal JSON
    if (formStatus.codfisc == !json.exists) {
        document.querySelector('.codfisc').classList.remove('error');
    } else {
        let text = document.createElement('span').textContent = "codice fiscale gi� utilizzato";
        document.querySelector('.codfisc').appendChild(text);
        document.querySelector('.codfisc').classList.add('error');
    }
    checkForm();
}


function jsonCheckUsername(json) {
    // Controllo il campo exists ritornato dal JSON
    if (formStatus.username == !json.exists) {
        document.querySelector('.username').classList.remove('error');
    } else {
        let text = document.createElement('span').textContent = "Nome utente gia' utilizzato";
        document.querySelector('.username').appendChild(text);
        
        document.querySelector('.username').classList.add('error');
    }
    checkForm();
}



function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function checkUsername(event) {
    const input = document.querySelector('.username input');

    if (!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        let text = document.createElement('span').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        document.querySelector('.username').appendChild(text);
        document.querySelector('.username').classList.add('error');
        formStatus.username = false;
        checkForm();
    } else {
        fetch("Check_username.php?q=" + encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckUsername);
    }
}



function checkPassword(event) {
    const passwordInput = document.querySelector('.password input');
    if (formStatus.password = passwordInput.value.length >= 8) {
        document.querySelector('.password').classList.remove('error');
    } else {
        document.querySelector('.password').classList.add('error');
    }
    checkForm();
}




function checkForm() { 
        // Controlla che tutti i campi siano pieni // Controlla che i campi non siano false
        Object.keys(formStatus).length !== 5 || Object.values(formStatus).includes(false);
}
       
        


document.querySelector('.username input').addEventListener('blur', checkUsername);
document.querySelector('.codfisc input').addEventListener('blur', checkCodfisc);
document.querySelector('.password input').addEventListener('blur', checkPassword);
//document.querySelector('.submit input').addEventListener('click',)


if (document.querySelector('.error') !== null) {
    checkUsername(); 
    checkPassword(); 
    checkCodfisc();
    document.querySelector('.username input').dispatchEvent(new Event('blur'));
    document.querySelector('.codfisc input').dispatchEvent(new Event('blur'));
}