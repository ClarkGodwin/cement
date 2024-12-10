var bot_form = document.querySelector('#modal div:last-child form'),
message = document.getElementById('message'),
section = document.querySelector('#modal div:last-child section'), 
cement_form = document.querySelector('#modal div:first-child form'),
info = document.querySelector('header div:last-of-type');  


//for the chatbot

bot_form.addEventListener('submit', function(event){
        event.preventDefault(); 
        var formdata = new FormData(this),
                data = Object.fromEntries(formdata.entries()); 
        message_value = message.value; 
        xhr = new XMLHttpRequest();
        xhr.open('POST', '../../Data/chatbot.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
        xhr.onreadystatechange = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                        section.innerHTML += '<span><h2>Vous : </h2><text>' + message_value + '</text></span>'; 
                        section.innerHTML += '<span><h2>Bot : </h2><text>' + xhr.responseText + '</text></span>'; 
                        message.innerHTML = ''; 
                }
        }; 
        xhr.send(JSON.stringify(data)); 
}); 

//for the sale of the cement

cement_form.addEventListener('submit', function(event){
        event.preventDefault(); 
        var formdata = new FormData(this),
                data = Object.fromEntries(formdata.entries()); 
        message_value = message.value; 
        xhr = new XMLHttpRequest();
        xhr.open('POST', '../../Data/sale.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
        xhr.onreadystatechange = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                        info.innerHTML = xhr.responseText; 
                        info.classList.remove('erase_message');
                        if(xhr.responseText == 'Merci pour votre achat'){
                                info.classList.add('success_message');
                        }
                        else{
                                info.classList.add('error_message');
                        }
                        setTimeout(function(){
                                eraseclass(info);
                                info.classList.add('erase_message')
                        }, 5000); 
                }
        }; 
        xhr.send(JSON.stringify(data)); 
}); 

function eraseclass(elt){
        elt.classList.remove(elt.classList.item(0)); 
}
