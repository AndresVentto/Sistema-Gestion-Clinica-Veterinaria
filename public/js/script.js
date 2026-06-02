/* Header y Login */
let loginForm = document.querySelector('.header .login-link');
document.querySelector('#login-btn').onclick = () =>{
    loginForm.classList.toggle('activo'); 
    navbar.classList.remove('activo'); 
}
/* Menu Hamburguesa */
let navbar = document.querySelector('.header .navbar');
document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('activo'); 
    loginForm.classList.remove('activo');
}
window.onscroll = () => {
    loginForm.classList.remove('activo');
    navbar.classList.remove('activo'); 
    if(window.scrollY > 0) {
        document.querySelector('.header').classList.add('activo');
    }else{
        document.querySelector('.header').classList.remove('activo');
    }
}
window.onload = () => {
    if(window.scrollY > 0) {
        document.querySelector('.header').classList.add('activo');
    }else{
        document.querySelector('.header').classList.remove('activo');
    }
}