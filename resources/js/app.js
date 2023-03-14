require('./bootstrap');

window.gsap = require('./gsap');
require('./morph');
require('./projects');
const VanillaTilt = require("vanilla-tilt");



/*=====================================

    BG Video Manager

=====================================*/
let video = document.querySelector("#bg_video video");
video.load();
let videoLoader = setInterval(function(){
    if(video.readyState === 4){
        video.parentElement.classList.add("loaded");
        video.play();
        clearInterval(videoLoader);
    }
},100);


/*============================

    Vanilla Tilt

============================*/
window.addEventListener('load', () => {
    VanillaTilt.init(document.querySelectorAll(".tilted"), {
        max: 25,
        speed: 400,
        perspective: 100,
        scale: 1.1
    });
});


/*============================

    Letter Animations

============================*/
const elements = ['ml16', 'ml12'];
elements.forEach(classes => {
    const textWrapper = document.querySelector('.' + classes);
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");
});

//Alexis Hayat - h1
anime.timeline()
    .add({
        targets: '.ml16 .letter',
        translateY: [-100,0],
        easing: "easeOutExpo",
        duration: 1400,
        delay: (el, i) => 30 * i
    });

//Follow me - h2
anime.timeline()
    .add({
        targets: '.ml12 .letter',
        translateX: [40,0],
        translateZ: 0,
        opacity: [0,1],
        easing: "easeOutExpo",
        duration: 1200,
        delay: (el, i) => 500 + 30 * i
    });

setTimeout(() => {
    document.querySelector('.ml16').classList.add('glitched');

    const description_content = document.querySelector('.description_content');
    description_content.animate([
        {
            opacity: 0
        },
        {
            opacity: 1
        }
    ], {
        duration: 1000,
        iterations: 1,
        easing: 'ease-in-out',
        fill: 'forwards'
    })
}, 1450);


const socials = document.querySelectorAll('.social_item');
let i = 0;
const animInterval = setInterval(() => {
    if(i >= socials.length - 1){
        clearInterval(animInterval);
    }

    const item = socials[i];
    item.animate([
        {
            transform: 'translateY(10vh)',
            opacity: 0
        },
        {
            transform: 'translateY(0)',
            opacity: 1
        }
    ], {
        duration: 600,
        iterations: 1,
        easing: 'ease-in-out',
        fill: 'forwards'
    });

    i++;

}, 100);


const projects = document.querySelector('.projects_wrapper');
projects.animate([
    {
        opacity: 0
    },
    {
        opacity: 1
    }
], {
    duration: 600,
    iterations: 1,
    easing: 'ease-in-out',
    fill: 'forwards'
});


/*==========================
    Social Handler
 ==========================*/
const socialOpenHandler = document.querySelector('.social_open_handler');
const socialItemsWrapper = document.querySelector('.social_items_wrapper');
socialOpenHandler.addEventListener('click', () => {
    socialItemsWrapper.querySelectorAll('.social_item').forEach((el) => {
        el.classList.toggle('opened');
    })
});

