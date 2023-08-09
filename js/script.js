function menu() {
    document.querySelector(".menu_mobile_open").addEventListener( 'click', () => {

    let menu_mobile  = document.querySelector('.menu_mobile');
    menu_mobile.style.display = "-webkit-flex";
    menu_mobile.style.top = "110px";
    menu_mobile.style.animation = "move ease-in 400ms";
     
        setTimeout(() => {
            document.querySelector('.menu_mobile_open').style.display = "none";
            document.querySelector('.menu_mobile_close').style.display = "flex";
        }, 200);
        if(window.innerWidth <= 480) {
            menu_mobile.style.top = "85px";
        }
    });
   
    document.querySelector(".menu_mobile_close").addEventListener( 'click', () => {

        let menu_close = document.querySelector('.menu_mobile');
        menu_close.style.top = "-100%";
        menu_close.style.animation = "move ease-out 400ms";
        
        setTimeout(() => {
            if (document.querySelector('.menu_mobile').style.top = "-100%") {
                document.querySelector('.menu_mobile').style.display = "none";
            }
        }, 600);

        setTimeout(() => {
            document.querySelector('.menu_mobile_open').style.display = "flex";
            document.querySelector('.menu_mobile_close').style.display = "none";
        }, 100);
    });
     

    
}
menu();
function faq() {

    const quest = document.querySelectorAll(".faq_quests");
    const aswer = document.querySelectorAll(".aswer");
    const img = document.querySelectorAll(".quest img");

    for (let i = 0; i < quest.length; i++) {

        quest[i].addEventListener("click", () => {

            if (quest[i].classList.contains("close")) {
                quest[i].classList.toggle("close");
                aswer[i].classList.toggle("open");
                img[i].style.transform = "rotate(0deg)";
            } else {
                quest[i].classList.add("close");
                aswer[i].classList.add("open");
                img[i].style.transform = "rotate(180deg)";
            }
        });

    }


}
faq();

function btn_menu() {

    let btn = document.querySelector(".btn_menu.desktop");
    let btn_m = document.querySelector(".btn_menu.mobile");
    let area_menu = document.querySelector(".area_drop_down_perfil");
    let area_menu_m = document.querySelector(".area_drop_down_perfil.mobile");

    btn.addEventListener( 'click', () => {
    
        if( area_menu.classList.contains('open') ) {
            area_menu.classList.toggle('open');
            area_menu.classList.toggle('close');
           
        }else {
            area_menu.classList.add('open');
            area_menu.classList.add('close');
            area_menu.classList.toggle('close');
        }

    });

    btn_m.addEventListener( 'click', () => {
       
        if( area_menu_m.classList.contains('open') ) {
            area_menu_m.classList.toggle('open');
            area_menu_m.classList.toggle('close');
           
        }else {
            area_menu_m.classList.add('open');
            area_menu_m.classList.add('close');
            area_menu_m.classList.toggle('close');
        }

    });
    
}
btn_menu();