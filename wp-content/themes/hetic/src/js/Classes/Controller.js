class Controller{
  constructor(container){
    this.container     = container
    this.button_toggle = this.container.querySelector('.section-videos-wrapper-controls--toggle')
    this.video         = this.container.querySelector('.section-videos-wrapper-video')
    
    this.time_seek_bar      = this.container.querySelector('.section-videos-wrapper-controls-seek-bar')
    this.time_seek_bar_fill = this.time_seek_bar.querySelector('.section-videos-wrapper-controls-seek-bar--fill')
    this.time_drag = false

    this.time_current  = this.container.querySelector('.section-videos-wrapper-controls--time-current')
    this.time_duration = this.container.querySelector('.section-videos-wrapper-controls--time-duration')
    
    this.button_volume = this.container.querySelector('.section-videos-wrapper-controls-volume--icon')
    this.volume_seek_bar      = this.container.querySelector('.section-videos-wrapper-controls-volume--bar')
    this.volume_seek_bar_fill = this.container.querySelector('.section-videos-wrapper-controls-volume--bar-fill')
    this.volume_drag = false

    this.effect_pause = this.container.querySelector('.section-videos-wrapper-effect-pause')
    this.effect_play  = this.container.querySelector('.section-videos-wrapper-effect-play')
    
    this.button_fullscreen = this.container.querySelector('.section-videos-wrapper-controls--fullscreen')

    this.container_playlist  = document.querySelector('.section-videos-nav-wrapper-list')
    this.playlist_items      = document.querySelectorAll('.section-videos-nav-wrapper-list-item')
    this.playlist_next       = document.querySelector('.section-videos-nav-controls--next')
    this.playlist_prev       = document.querySelector('.section-videos-nav-controls--prev')
    this.playlist_index      = 0
    this.playlist_item_width = this.playlist_items[0].getBoundingClientRect().width + 20

    this.button_toggle.addEventListener('click', ()=>{
      this.toggleState()
    })

    this.time_seek_bar.addEventListener('click', (e)=>{
      this.time_positions = this.time_seek_bar.getBoundingClientRect()
      
      this.updateTime(e)
    })

    this.time_seek_bar.addEventListener('mousedown', ()=>{
      if(!this.time_drag){
        this.time_positions = this.time_seek_bar.getBoundingClientRect()      
        this.time_drag = true
      }
    })

    window.addEventListener('mouseup', ()=>{
      if(this.time_drag){
        this.time_drag = false
      }

      if(this.volume_drag){
        this.volume_drag = false
      }
    })

    window.addEventListener('mousemove', (e)=>{
      if(this.time_drag){
        this.updateTime(e)
      }
      if(this.volume_drag){
        this.updateVolume(e)        
      }
    })

    this.button_volume.addEventListener('click', () =>{
      this.toggleMute()
    })

    this.volume_seek_bar.addEventListener('click', (e) =>{
      this.volume_positions = this.volume_seek_bar.getBoundingClientRect()
      this.updateVolume(e)
    })

    this.volume_seek_bar.addEventListener('mousedown', ()=>{
      if(!this.volume_drag){
        this.volume_positions = this.volume_seek_bar.getBoundingClientRect()      
        this.volume_drag = true
      }
    })

    this.button_fullscreen.addEventListener('click', ()=>{
      this.toggleFullscreen()
    })

    this.video.addEventListener('dblclick', ()=>{
      this.toggleFullscreen()      
    })

    this.video.addEventListener('click', ()=>{
      this.toggleState()
      if(this.video.paused){
        this.effect_play.classList.add('active')
        this.effect_pause.classList.remove('active')
      }
      else{
        this.effect_pause.classList.add('active')
        this.effect_play.classList.remove('active')        
      }
    })

    this.playlist_next.addEventListener('click', ()=>{
      if(this.playlist_index < this.playlist_items.length - 5){
        this.playlist_index++
        console.log(this.playlist_index)
        console.log('next')
        this.updatePlaylist()
        this.playlist_prev.classList.remove('hide')
        if(this.playlist_index  == this.playlist_items.length - 5){
          this.playlist_next.classList.add('hide')          
        }
      }
    })

    this.playlist_prev.addEventListener('click', ()=>{
      if(this.playlist_index > 0){
        this.playlist_index--
        console.log(this.playlist_index)        
        console.log('prev')
        this.updatePlaylist()
        this.playlist_next.classList.remove('hide') 
        if(this.playlist_index == 0){
          this.playlist_prev.classList.add('hide')          
        }     
      }
    })

    window.addEventListener('resize', ()=>{
      this.playlist_item_width = this.playlist_items[0].getBoundingClientRect().width + 20      
      this.updatePlaylist()
    })
  }

  // init new video
  init(){
    this.video.addEventListener('loadeddata', () =>{
      this.video.pause()
      this.video.currentTime = 0
      this.time_duration.textContent = this.formatTime(this.video.duration)   
      this.time_current.textContent = this.formatTime(this.video.currentTime)       
      
      this.time_seek_bar_fill.style.transform = 'scaleX(0)'    
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
    this.effect_pause.classList.remove('active')
    this.effect_play.classList.remove('active')
  }

  updateTime(e){
    let ratio = (e.pageX - this.time_positions.left) / this.time_positions.width
    this.time_seek_bar_fill.style.transform = 'scaleX('+ ratio +')'
    this.video.currentTime = ratio * this.video.duration
    this.time_current.textContent = this.formatTime(this.video.currentTime)
  }

  updateVolume(e){
    let ratio = (e.pageX - this.volume_positions.left) / this.volume_positions.width
    this.video.volume = ratio
    this.volume_seek_bar_fill.style.transform = 'scaleX('+ ratio +')'    
    if(this.video.muted){
      this.toggleMute()
    }

    if(ratio >= .5){
      this.button_volume.classList.add('volume-2')
      this.button_volume.classList.remove('volume-1')
      this.button_volume.classList.remove('volume-0')
    }
    else if(ratio < .5 && ratio >= .25){
      this.button_volume.classList.remove('volume-2')
      this.button_volume.classList.add('volume-1')
      this.button_volume.classList.remove('volume-0')
    }
    else if(ratio < .25){
      this.button_volume.classList.remove('volume-2')
      this.button_volume.classList.remove('volume-1')
      this.button_volume.classList.add('volume-0')
    }
    else if(ratio <= 0){
      this.button_volume.classList.remove('volume-2')
      this.button_volume.classList.remove('volume-1')
      this.button_volume.classList.remove('volume-0')
      this.toggleMute()
    }
  }

  toggleMute(){
    if(this.video.muted){
      this.video.muted = false
      this.button_volume.classList.remove('mute')
      this.volume_seek_bar_fill.style.transform = 'scaleX('+ this.video.volume +')'          
    }
    else{
      this.video.muted = true
      this.button_volume.classList.add('mute')
      this.volume_seek_bar_fill.style.transform = 'scaleX(0)'    
    }
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

  //playlist
  updatePlaylist(){
    this.container_playlist.style.transform = 'translateX(-'+ (this.playlist_index * this.playlist_item_width) +'px)'
  }  


  //render func
  render(){
    if(!this.video.paused){
      window.requestAnimationFrame(this.render.bind(this))
    }

    let ratio = this.video.currentTime / this.video.duration
    this.time_seek_bar_fill.style.transform = 'scaleX('+ ratio +')'

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