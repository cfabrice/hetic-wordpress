// HEADER BURGER
const burger_button = document.querySelector('.header-burger')
const burger_nav = document.querySelector('.header-nav')

burger_button.addEventListener('click', function () {
  burger_button.classList.toggle('header-burger-active')
  burger_nav.classList.toggle('header-nav-expand')
})

const header = document.querySelector('.header')
var header_hide = false
document.body.addEventListener('mousewheel', function (e) {
  if (!header_hide && e.deltaY < 0 && !scroll_disabled) {
    header.classList.remove('hide')
    header_hide = true
  }
  else if (header_hide && e.deltaY > 0 && document.body.scrollTop > 80 && !scroll_disabled) {
    header.classList.add('hide')
    header_hide = false
  }
})
// SCROLL DISABLE
const disabled_elements = document.querySelectorAll('.scroll-disable')
var scroll_disabled = false
for (var i = 0; i < disabled_elements.length; i++) {
  disabled_elements[i].addEventListener('mouseenter', () => {
    scroll_disabled = true
  })
  disabled_elements[i].addEventListener('mouseleave', () => {
    scroll_disabled = false
  })
}

// EXHIBITIONS SLIDER
if (document.querySelector('.section-exhibitions') != undefined) {
  const exhibitions_buttons_item = document.querySelectorAll('.section-exhibitions-container-slider-nav-list--item')
  const exhibitions_buttons_container = document.querySelector('.section-exhibitions-container-slider-nav-list')
  const exhibitions_list_img = document.querySelector('.section-exhibitions-container-slider-wrapper-list')
  const exhibitions_list_content = document.querySelector('.section-exhibitions-container-content-wrapper-list')
  let exhibitions_last_index = 0
  
  for (var i = 0; i < exhibitions_buttons_item.length; i++) {
    exhibitions_buttons_item[i].addEventListener('click', function () {
      let index = Array.prototype.indexOf.call(exhibitions_buttons_item, this)
      
      if (exhibitions_buttons_item[exhibitions_last_index] != undefined) {
        exhibitions_buttons_item[exhibitions_last_index].classList.remove('active')
      }
      exhibitions_last_index = index
      
      exhibitions_buttons_item[index].classList.add('active')
      
      if (window.innerWidth >= 900) {
        exhibitions_list_img.style.transform = 'translateX(-' + (index * 100) + '%)'
        exhibitions_list_content.style.transform = 'translateX(-' + (index * 100) + '%)'
      }
      else {
        exhibitions_list_img.style.transform = 'translateX(-' + (index * 100) + '%)'
        exhibitions_list_content.style.transform = 'translateX(-' + (index * 100) + '%)'
        exhibitions_buttons_container.style.transform = 'translateX(-' + (((index - 1) / 3) * 100) + '%)'
      }
    })
  }
}

// HOME PLAYER)
if (document.querySelector('#video-home') != undefined) {
  const player = new Player(document.querySelector('#video-home'), true)
}

// SLIDER
if (document.querySelector('.slider') != undefined) {
  const slider = new Slider(document.querySelector('.slider'))
}

if (document.querySelector('#instagramDate') != undefined) {
  let instagramDate = document.querySelector('#instagramDate')
  const d = instagramDate.getAttribute('datetime')
  instagramDate.innerText = moment(d).locale('fr').fromNow()
}
new Exhibitions()
new News()
new Projects()
