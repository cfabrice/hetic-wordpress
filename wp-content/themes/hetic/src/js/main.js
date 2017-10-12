const burger_button = document.querySelector('.header-burger')
const burger_nav    = document.querySelector('.header-nav')

burger_button.addEventListener('click', function(){
  burger_button.classList.toggle('header-burger-active')
  burger_nav.classList.toggle('header-nav-expand')
})
