const menu = document.getElementById('menu');
const indicador = document.getElementById('indicador');
const secciones = document.querySelectorAll('.seccion');
const logo = document.getElementById('logo');

let tamanioIndicador = menu.querySelector('a').offsetWidth;
indicador.style.width = tamanioIndicador+"px";

let indexSeccionActiva;
console.log(window.innerWidth);
//Observador de secciones
if(window.innerWidth > 980){
    console.log('aqui');
    const observer = new IntersectionObserver((entradas, observer) => {
        entradas.forEach(entrada => {
            if(entrada.isIntersecting){
                indexSeccionActiva = [...secciones].indexOf(entrada.target); // ... operador spreed, se utiliza indexOf(entrada.target) para indicar que entrada es la que esta en el viewPort
                
                if(indexSeccionActiva == -1){
                    indicador.style.transform = `translate(${tamanioIndicador * indexSeccionActiva - 1000}px)`;
                    logo.style.width = "15rem";
                }else{
                        indicador.style.transform = `translate(${tamanioIndicador * indexSeccionActiva}px)`;
                        logo.style.width = "5rem";
                }
    
                
            }
        });
     
    
    },{
        rootMargin: '-80px 0px 0px 0px', //Sirve para indicar a partir de cuanto margen empezara a medir
        threshold: 0.3 //Indica cuanto porcentaje debe tomar en cuenta que esta dentro del viewport
    });

        //agregamos un observador para el hero
    observer.observe(document.getElementById('hero'));

    //se arregla un observer a cada seccion
    secciones.forEach(seccion => observer.observe(seccion));
}

//Evento para resize

const onResize = () => {
    //calculamos el tamanio del indicador
    tamanioIndicador = menu.querySelector('a').offsetWidth;
    //seteamos el tamanio del indicador
    indicador.style.width = `${tamanioIndicador}px`;

    //volvemos a posicionar el indicador
    indicador.style.transform = `translate(${tamanioIndicador * indexSeccionActiva}px)`;
    

}

window.addEventListener('resize', onResize);