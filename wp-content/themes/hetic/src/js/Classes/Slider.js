class Slider{
  constructor(container){
    this.container   = container
    this.items       = this.container.querySelectorAll('.slider-item')
    this.button_next = this.container.querySelector('.slider-next')
    this.button_prev = this.container.querySelector('.slider-prev')
    this.timer_fill  = this.container.querySelector('.slider-timer-fill')
    this.text_current = this.container.querySelector('.slider-index-current')
    this.text_total = this.container.querySelector('.slider-index-total')
    
    this.index      = 0
    this.stacking   = 1
    this.last_index = 0

    this.slide_interval = 4000
    this.last_update    = 0
    this.need_update    = true
    this.draw           = true

    this.init()
    this.render()
    this.startInterval()

    this.button_next.addEventListener('click', ()=>{
      if(!this.clicked){
        if(this.index < this.items.length - 1){
          this.index ++
        }
        else{
          this.index = 0
        }
        this.update()
      }
    })

    this.button_prev.addEventListener('click', ()=>{
      if(!this.clicked){ 
        if(this.index > 0){
          this.index --
        }
        else{
          this.index = this.items.length - 1
        }
        this.update()
      }
    })
  }

  startInterval(){
    this.interval = setTimeout(()=>{
      
      this.button_next.click()
      this.startInterval()
    }, this.slide_interval)
  }

  init(){
    this.text_total.textContent = this.items.length > 9 ? this.items.length : '0' + this.items.length     
    this.index = 0
    this.items[this.index].classList.add('active')
    this.text_current.textContent = (this.index+1) > 9 ? (this.index+1) : '0' + (this.index+1) 
  }

  update(){
    this.text_total.textContent = this.items.length > 9 ? this.items.length : '0' + this.items.length     
    this.text_current.textContent = (this.index+1) > 9 ? (this.index+1) : '0' + (this.index+1)

    this.items[this.index].style.zIndex = this.stacking++

    // this.items[this.index].classList.add('up-index')
    // this.items[this.last_index].classList.remove('up-index')
    this.items[this.index].classList.add('active')    

    this.clicked = true
    this.draw    = false
    this.timer_fill.classList.add('fill')
    

    setTimeout(() => {
      this.items[this.last_index].classList.remove('active')
      this.last_index = this.index
      this.clicked = false

      clearTimeout(this.interval)
      this.startInterval()

      this.timer_fill.classList.remove('fill')      
      this.need_update = true
      this.draw        = true
    }, 610)

    console.log('-------')    
    
  }

  render(time){
    // console.log(time)
    if(this.need_update || this.last_update === undefined || time === undefined){
      this.last_update = time
      this.need_update = false
    }
    // console.log(time - this.last_update / this.duration)
    if((time - this.last_update) / this.slide_interval >= 1){
      let ratio = (time - this.last_update) / this.slide_interval
      this.timer_fill.style.transform = 'scaleX('+ ratio +')'
      this.last_update = time      
    }

    if(this.draw){
      let ratio = (time - this.last_update) / this.slide_interval
      this.timer_fill.style.transform = 'scaleX('+ ratio +')'
    }
    else{
      this.timer_fill.style.transform = null      
    }

    window.requestAnimationFrame(this.render.bind(this))
  }

}