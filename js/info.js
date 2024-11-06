const imgfav = document.getElementById("imgfav");
const favorito = document.getElementById("favorito");

imgfav.onclick = function(){
    var pass = imgfav.src;
    if(pass == 'http://localhost/ProyectoFinalLBD/imagenes/recursos/whiteheart.png'){
        imgfav.src = 'http://localhost/ProyectoFinalLBD/imagenes/recursos/heartgreen.png';
        favorito.value = "S";
    }else{
        imgfav.src = 'http://localhost/ProyectoFinalLBD/imagenes/recursos/whiteheart.png';
        favorito.value = "N";
    }
}

const desplegar = document.getElementById("desplegar");
const agregarvis = document.getElementById("agregarvis");
const el = document.getElementById('agregarvis')
el.scrollIntoView({block: 'start', behavior: 'smooth'});

desplegar.onclick = function(){
    agregarvis.style.display = 'block';
    el.scrollIntoView({block: 'start', behavior: 'smooth'});
}

