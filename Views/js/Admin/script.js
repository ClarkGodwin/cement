var li = document.querySelectorAll('nav ul li'),
        li_actual = sessionStorage.getItem('li_actual'),
        click = new Event('click'),  
        content = document.querySelector('.content div'),
        link = document.querySelector('head link:last-of-type'),
        script = document.querySelector('body script:last-of-type'),
        default_content = '<h3 id="h3">Bienvenu sur le site d\'administrateur</h3><p>Servez vous de la bar de navigation pour effectuer toutes sorte de modification aux tables de la base de donnees et/ou pour vous deconnecter</p>',
        details_id,
        modal = document.querySelector('.modal'),
        details_modal = document.querySelector('.modal .details');    

for(let i=0; i < li.length; i++){
        li[i].addEventListener('click', function(event){
                li[i].classList.add('active'); 
                li[i].scrollIntoView(); 

                if(i == 0){
                        content.innerHTML = default_content; 
                }
                else{
                        page_load(li[i].innerHTML); 
                }

                for(let y=0; y < li.length; y++){
                        if(i != y){
                                li[y].classList.remove('active'); 
                        }
                }
        }); 
}

function page_load(page){
        page_ = page; 

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'Tables/'+page+'.php', true); 

        xhr.onreadystatechange = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                        var data = JSON.parse(xhr.responseText); 

                        content.innerHTML = data.content; 
                        
                        if('link' in data){
                                link.setAttribute('href', data.link); 
                        }

                        // dom_ajax(); 
                        function details(id){
                                modal.classList.remove('hide_modal'); 
                                modal.classList.add('display_modal'); 
                                details_modal.classList.remove('hide_modal'); 
                                details_modal.classList.add('display_modal'); 
                                details_id = id; 
                        }
                }
        }

        xhr.send(null); 
}
document.addEventListener('DOMContentLoaded', page_load)

window.addEventListener('beforeunload', function(){
        for(let i=0; i < li.length; i++){
                if(li[i].classList.contains('active')){
                        sessionStorage.setItem('li_actual', i); 
                }
        }

}); 

window.addEventListener('load', function(){
        for(let i=0; i < li.length; i++){
                if(i == li_actual){
                        li[li_actual].dispatchEvent(click); 
                }
        }

})


function dom_ajax(){
        details(details_id); 
}

