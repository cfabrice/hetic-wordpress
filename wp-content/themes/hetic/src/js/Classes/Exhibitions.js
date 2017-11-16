class Exhibitions {
  constructor () {
    const exhibitions = document.querySelector('#exhibitions')
    if (exhibitions) {
      new Vue({
        el: '#exhibitions',
        data: {
          years: [],
          activeYear: 2014,
          article: {
            title: '',
            content: '',
            photos: [],
            video: []
          },
          exhibitions: [],
          loaderArticle: false,
          loaderHeight: '400px',
        },
        mounted () {
          this.getYears()
        },
        methods: {
          getYears () {
            let form_data = new FormData
            form_data.append('action', 'get_years')
            axios.post(`${ajaxurl}`, form_data).then(res => {
              this.years = res.data
              this.setActiveYear(this.years[0].name)
            }).catch(err => {
              console.log(err)
            })
          },
          getExhibitions () {
            let form_data = new FormData
            form_data.append('action', 'get_exhibitions')
            form_data.append('year', this.activeYear)
            axios.post(`${ajaxurl}`, form_data).then(res => {
              this.exhibitions = res.data
              if (res.data.length > 0) {
                this.article.title = res.data[0].post_title
                this.article.content = res.data[0].content
                this.article.photos = res.data[0].photos
                this.article.video = res.data[0].video
                if (res.data[0].video) {
                  setTimeout(function () {
                    new Player(document.querySelector('.section-videos-wrapper-e'), false)
                  }, 100)
                }
                if (res.data[0].photos) {
                  setTimeout(function () {
                    new Slider(document.querySelector('.slider-e'))
                  }, 100)
                }
              } else {
                this.article.title = ''
                this.article.content = ''
              }
            }).catch(err => {
              console.log(err)
            })
          },
          getArticle (postId) {
            let form_data = new FormData
            form_data.append('action', 'get_exhibition')
            form_data.append('id', postId)
            this.loaderArticle = true
            axios.post(`${ajaxurl}`, form_data).then(res => {
              this.article.title = res.data.post_title
              this.article.content = res.data.content
              this.article.photos = res.data.photos
              this.article.video = res.data.video
              this.loaderArticle = false
              if (res.data.video) {
                setTimeout(function () {
                  new Player(document.querySelector('.section-videos-wrapper-e'), false)
                }, 100)
              }
              if (res.data.photos) {
                setTimeout(function () {
                  new Slider(document.querySelector('.slider-e'))
                }, 100)
              }
            }).catch(err => {
              console.log(err)
            })
          },
          setActiveYear (year) {
            this.activeYear = year
            this.getExhibitions(this.activeYear)
          }
        }
      })
    }
  }
}