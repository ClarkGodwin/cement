var li = document.querySelectorAll('nav ul li'),
        li_actual = sessionStorage.getItem('li_actual'),
        click = new Event('click'),  
        content = document.querySelector('.content div'),
        link = document.querySelector('head link:last-of-type'),
        script = document.querySelector('body script:last-of-type'),
        default_content = '<h3>Bienvenu sur le site d\'administrateur</h3><p>Servez vous de la bar de navigation pour effectuer toutes sorte de modification aux tables de la base de donnees et/ou pour vous deconnecter</p>'; 

for(let i=0; i < li.length; i++){
        li[i].addEventListener('click', function(event){
                li[i].classList.add('active'); 
                li[i].scrollIntoView(); 

                if(i == 0){
                        content.innerHTML = default_content; 
                }
                else{
                        page_load(li[i].innerHTML, 0); 
                }

                for(let y=0; y < li.length; y++){
                        if(i != y){
                                li[y].classList.remove('active'); 
                        }
                }
        }); 
}

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


function page_load(page, i, action=''){
        if(i == 0){
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'Tables/'+page+'.php', true); 
                
                xhr.onreadystatechange = function(){
                        if(xhr.readyState == 4 && xhr.status == 200){
                                var data = JSON.parse(xhr.responseText); 
        
                                console.log(data)
                                content.innerHTML = data.content; 
                                if('link' in data){
                                        link.setAttribute('href', data.link); 
                                }
                                var details = document.querySelectorAll('.details'),
                                        modifier = document.querySelectorAll('.modifier');  

                                for(let i=0; i < details.length; i++){
                                        let id = details[i].getAttribute('id'); 
                                        
                                        details[i].addEventListener('click', function(){
                                                page_load(page, id, 'details'); 
                                        });
                                        
                                        modifier[i].addEventListener('click', function(){
                                                page_load(page, id, 'modifier'); 
                                        });
                                
                                }
                        }
                }
                
                xhr.send(null); 
        }
        else{
                function dashboard(){
                        page_load(page, 0); 
                }

                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'Tables/'+page+'.php?action='+action+'&id='+i, true); 
                
                xhr.onreadystatechange = function(){
                        if(xhr.readyState == 4 && xhr.status == 200){
                                var data = JSON.parse(xhr.responseText); 
        
                                console.log(data)
                                content.innerHTML = data.content; 
                                if('link' in data){
                                        link.setAttribute('href', data.link); 
                                }
        
                                var modal = document.querySelector('.modal');
                                        
                                var details = document.querySelectorAll('.details'); 
                                for(let i=0; i < details.length; i++){
                                        let id = details[i].getAttribute('id'); 
                                        
                                        details[i].addEventListener('click', function(){
                                                modal.style.display = 'block';
                                        });
                                        details[i].dispatchEvent(click);
                                
                                }
                                
                                var close_icone = document.querySelectorAll('.modal svg');
                                for(let y=0; y < close_icone.length; y++){
                                        close_icone[y].addEventListener('click', dashboard)
                                }
                        }
                }
                xhr.send(null); 
        }
}
