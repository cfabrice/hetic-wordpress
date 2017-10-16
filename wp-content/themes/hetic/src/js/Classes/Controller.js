class Controller{
  constructor(container){
    this.container     = container
    this.button_toggle = this.container.querySelector('.section-videos-wrapper-controls--toggle')
    this.video         = this.container.querySelector('.section-videos-wrapper-video')
    this.seek_bar      = this.container.querySelector('.section-videos-wrapper-controls-seek-bar')
    this.seek_bar_fill = this.seek_bar.querySelector('.section-videos-wrapper-controls-seek-bar--fill')
    this.time_current  = this.container.querySelector('.section-videos-wrapper-controls--time-current')
    this.time_duration = this.container.querySelector('.section-videos-wrapper-controls--time-duration')
    this.time_drag     = false
    this.button_volume = this.container.querySelector('.section-videos-wrapper-controls-volume--icon')
    this.button_fullscreen = this.container.querySelector('.section-videos-wrapper-controls--fullscreen')    

    this.time_duration.textContent = this.video.duration    

    this.button_toggle.addEventListener('click', ()=>{
      this.toggleState()
    })

    this.seek_bar.addEventListener('click', (e)=>{
      this.container_positions = this.seek_bar.getBoundingClientRect()
      
      this.updateTime(e)

      // if(this.video.paused){
      //   this.toggleState()
      // }
    })

    this.seek_bar.addEventListener('mousedown', ()=>{
      if(!this.time_drag){
        this.container_positions = this.seek_bar.getBoundingClientRect()      
        this.time_drag = true
      }
    })

    window.addEventListener('mouseup', ()=>{
      if(this.time_drag){
        this.time_drag = false
      }
    })

    window.addEventListener('mousemove', (e)=>{
      if(this.time_drag){
        this.updateTime(e)
      }
    })

    this.button_volume.addEventListener('click', () =>{
      if(this.video.muted){
        this.video.muted = false
        this.button_volume.classList.remove('mute')
      }
      else{
        this.video.muted = true
        this.button_volume.classList.add('mute')        
      }
    })


    this.button_fullscreen.addEventListener('click', ()=>{
      this.toggleFullscreen()
    })
  }

  // init new video
  init(){
    this.video.addEventListener('loadeddata', () =>{
      this.video.pause()
      this.video.volume = .5    
      this.video.currentTime = 0
      this.time_duration.textContent = this.formatTime(this.video.duration)   
      this.time_current.textContent = this.formatTime(this.video.currentTime)       
      
      this.seek_bar_fill.style.transform = 'scaleX(0)'    
    })    
  }


  //update func
  toggleState(){
    if(this.video.paused){
      this.video.play()
      this.container.classList.add('playing')
      this.render()
    }
    else{
      this.video.pause()
      this.container.classList.remove('playing')
    }
  }

  updateTime(e){
    let ratio = (e.pageX - this.container_positions.left) / this.container_positions.width
    this.seek_bar_fill.style.transform = 'scaleX('+ ratio +')'
    this.video.currentTime = ratio * this.video.duration
    this.time_current.textContent = this.formatTime(this.video.currentTime)
  }

  toggleFullscreen(){
    if(document.fullscreenElement == null && document.mozFullscreenElement == null && document.webkitFullscreenElement == null && document.msFullscreenElement== null ){
      if(this.container.requestFullscreen){
        this.container.requestFullscreen()
      }
      else if(this.container.mozRequestFullScreen){
        this.container.mozRequestFullScreen()
      }
      else if(this.container.webkitRequestFullscreen){
        this.container.webkitRequestFullscreen()
      }
      else if(this.container.msRequestFullscreen){
        this.container.msRequestFullscreen()
      }
    }
    else{
      if(document.exitFullscreen){
        document.exitFullscreen()
      }
      else if(document.mozExitFullScreen){
        document.mozExitFullScreen()
      }
      else if(document.webkitExitFullscreen){
        document.webkitExitFullscreen()
      }
      else if(document.msExitFullscreen){
        document.msExitFullscreen()
      }
    }
  }


  //render func
  render(){
    if(!this.video.paused){
      window.requestAnimationFrame(this.render.bind(this))
    }

    let ratio = this.video.currentTime / this.video.duration
    this.seek_bar_fill.style.transform = 'scaleX('+ ratio +')'

    this.time_current.textContent = this.formatTime(this.video.currentTime)
    
    if(this.video.currentTime == this.video.duration){
      this.container.classList.remove('playing')      
    }
  }


  // usefull func
  formatTime(time){
    time  = Math.round(time)
    let hours   = Math.floor(time / 3600);
    let minutes = Math.floor((time - (hours * 3600)) / 60);
    let seconds = time - (hours * 3600) - (minutes * 60);

    hours   = hours   < 10 ? "0"+hours : hours
    minutes = minutes < 10 ? "0"+minutes : minutes
    seconds = seconds < 10 ? "0"+seconds : seconds

    if(hours != 0){
      return hours+':'+minutes+':'+seconds
    }
    else{
      return minutes+':'+seconds
    }
  }
}

const controller = new Controller(document.querySelector('.section-videos-wrapper'))
controller.init()
console.log(controller)