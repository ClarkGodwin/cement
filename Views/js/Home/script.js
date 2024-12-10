var menu = document.getElementById('menu'),
        open = document.getElementById('open'),
        close = document.getElementById('close'),
        containers = document.querySelectorAll('.pictures'), 
        logos = document.querySelectorAll('.pictures img:first-child'),
        modal = document.getElementById('modal');  
        form = document.querySelector('#modal div:first-child'),
        chatbot = document.querySelector('#modal div:last-child');

function toggle_menu(){
        menu.classList.toggle('display_menu'); 
        menu.classList.toggle('menu'); 
        open.classList.toggle('display_svg'); 
        close.classList.toggle('display_svg'); 
        open.classList.toggle('hide_svg'); 
        close.classList.toggle('hide_svg'); 
}

setInterval(load, 1); 

function load(){
        for(let i=0; i < logos.length; i++){
                let nbr = logos[i].offsetHeight; 
                let str = String(nbr) + 'px';
                containers[i].style.height = str; 
        }
}

function form_open(){
        modal.style.display = 'block';
        form.style.display = 'block';
        chatbot.style.display = 'none'; 
}

function chatbot_open(){
        modal.style.display = 'block';
        form.style.display = 'none';
        chatbot.style.display = 'block'; 
}

function modal_close(){
        modal.style.display = 'none';
}
