require('./bootstrap');

import ShoppingCartBB from './cart'; // depend on your folder structure & filename
global.Wizard = ShoppingCartBB; // can be attached to window.ShoppingCartBB

import LikesCartBB from './likes'; // depend on your folder structure & filename
global.Wizard = LikesCartBB; // can be attached to window.LikesCartBB




//search container open/close
let searchContainer = document.querySelectorAll('.bb-search__container'); //контейнер
let searchIcon = document.querySelectorAll('.bb-search-btn-icon'); //кнопка с увличительным стеклом е
let searchCloseIcon = document.querySelectorAll('.bb-search__close-icon');
let searchInputButton = document.querySelectorAll('.search_input_button');

searchIcon.forEach(item => {
        item.addEventListener('click', event => {
            item.classList.add("bb-nav-desc__round-icon_hiden");
            searchContainer.forEach(item => item.classList.add("bb-search__container_opened"))
            searchCloseIcon.forEach(item => item.classList.add("bb-search__close-icon-visible"))
            searchInputButton.forEach(item => item.classList.add("bb-search__button_show"))
        })
    })

searchCloseIcon.forEach(item => {
    item.addEventListener('click', event => {
        item.classList.remove("bb-search__close-icon-visible");
        searchContainer.forEach(item => item.classList.remove("bb-search__container_opened"))
        searchInputButton.forEach(item => item.classList.remove("bb-search__button_show"))
        setTimeout(() => {
            searchIcon.forEach(item => item.classList.remove("bb-nav-desc__round-icon_hiden"))
        }, 200);
    })
})



//if search input empty, search button disabled
let search_input = document.querySelector('.search_input_bb');
let search_input_button = document.querySelector('.search_input_button');

window.onload = function () {
    if (search_input.value.length == 0)
        search_input_button.disabled = true
};
search_input.addEventListener('input', updateValue);

function updateValue(e) {
    function сheckSpaces(str) {
        return str.trim() !== '';
    }
    if (!сheckSpaces(e.target.value)) {
        search_input_button.disabled = true
    } else {
        search_input_button.disabled = false
     }
}


//colaps menu toggle
let navMobBurger = document.querySelector('#bb-nav-mob__burger');
let backgroundToggler = document.querySelector('.bb-nav-mob__background-toggler');
let bbNavMob = document.querySelector('.bb-nav-mob');
let bbNavNobClose = document.querySelector('.bb-nav-mob__close');
navMobBurger.addEventListener('click', function(){
    bbNavMobOpen()
})

backgroundToggler.addEventListener('click', function() {
    bbNavMobClose()
})

bbNavNobClose.addEventListener('click', function() {
    bbNavMobClose()
})

function bbNavMobOpen(){
    backgroundToggler.classList.add("bb-nav-mob__background-toggler_opened")
    bbNavMob.classList.add("bb-nav-mob_open")
    bbNavNobClose.classList.add('bb-nav-mob__close_show')
    navMobBurger.classList.add('bb-nav-mob__burger_hide')
}

function bbNavMobClose(){
    bbNavMob.classList.remove("bb-nav-mob_open")
    backgroundToggler.classList.remove("bb-nav-mob__background-toggler_opened")
    bbNavNobClose.classList.remove('bb-nav-mob__close_show')
    navMobBurger.classList.remove('bb-nav-mob__burger_hide')
}

//catalog open
let bbNavCatalogBtn = document.querySelectorAll('.bb-catalog-btn') //кнопка закрыть/открыть
let bbCatalog = document.querySelectorAll('.bb-catalog')//каталог

bbNavCatalogBtn.forEach(item => {
    item.addEventListener('click', event => {
        item.classList.toggle('bb-catalog-btn_close')
        bbCatalog.forEach(item =>{item.classList.toggle('bb-catalog_show')})
    })
})



