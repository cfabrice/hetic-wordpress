const burger_button = document.querySelector('.header-burger')
const burger_nav    = document.querySelector('.header-nav')

burger_button.addEventListener('click', function(){
  burger_button.classList.toggle('header-burger-active')
  burger_nav.classList.toggle('header-nav-expand')
})



const exhibitions_buttons_item      = document.querySelectorAll('.section-exhibitions-container-slider-nav-list--item')
const exhibitions_buttons_container = document.querySelector('.section-exhibitions-container-slider-nav-list')
const exhibitions_list_img          = document.querySelector('.section-exhibitions-container-slider-wrapper-list')
const exhibitions_list_content      = document.querySelector('.section-exhibitions-container-content-wrapper-list')
let exhibitions_last_index          = 0

for (var i = 0; i < exhibitions_buttons_item.length; i++) {
  exhibitions_buttons_item[i].addEventListener('click', function(){
    let index = Array.prototype.indexOf.call(exhibitions_buttons_item, this)

    if(exhibitions_buttons_item[exhibitions_last_index] != undefined){
      exhibitions_buttons_item[exhibitions_last_index].classList.remove('active')
    }
    exhibitions_last_index = index

    exhibitions_buttons_item[index].classList.add('active')

    if(window.innerWidth >= 900){
      exhibitions_list_img.style.transform = 'translateX(-'+ (index * 100) +'%)'
      exhibitions_list_content.style.transform = 'translateX(-'+ (index * 100) +'%)'
    }
    else{
      exhibitions_list_img.style.transform = 'translateX(-'+ (index * 100) +'%)'
      exhibitions_list_content.style.transform = 'translateX(-'+ (index * 100) +'%)'
      exhibitions_buttons_container.style.transform = 'translateX(-'+ (((index-1)/3) * 100) +'%)'
    }

  })
}

const controller = new Controller(document.querySelector('.section-videos-wrapper'))
controller.init()

console.log(controller)