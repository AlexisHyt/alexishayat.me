require('./bootstrap');

const particlesJs = require('particles.js');

const VanillaTilt = require("vanilla-tilt");


/*============================

    Vanilla Tilt

============================*/
window.addEventListener('load', () => {
    VanillaTilt.init(document.querySelectorAll(".tilted"), {
        max: 1,
        speed: 400,
        perspective: 100,
        scale: 1.02
    });
});


/*============================

    Particles JS

============================*/
particlesJS.load('particles', '../assets/particlesjs-config.json', function() {});

