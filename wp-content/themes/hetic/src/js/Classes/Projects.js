class Projects {
  constructor () {
    const projects = document.querySelector('#projects')
    if (projects) {
      new Vue({
        el: '#projects',
        data: {
          projects: [],
          projectsDetails: [],
          activeProject: '',
          activeProjectSlug: '',
          article: {
            title: '',
            content: '',
            year: '',
            photos: [],
            videos: []
          },
          loaderArticle: false,
          loaderHeight: '400px',
        },
        mounted () {
          this.loaderArticle = true
          this.getProjects()
        },
        methods: {
          getProjects () {
            let form_data = new FormData
            form_data.append('action', 'get_projects_categories')
            axios.post(`${ajaxurl}`, form_data).then(res => {
              this.projects = res.data
              this.setActiveProject(this.projects[0].name, this.projects[0].slug)
              this.loaderArticle = false
            }).catch(err => {
              console.log(err)
            })
          },
          getProjectsDetails () {
            let form_data = new FormData
            form_data.append('action', 'get_projects_details')
            form_data.append('project_category', this.activeProjectSlug)
            axios.post(`${ajaxurl}`, form_data).then(res => {
              this.projectsDetails = res.data
              if (res.data.length > 0) {
                this.article.title = res.data[0].post_title
                this.article.content = res.data[0].content
                this.article.photos = res.data[0].photos
                this.article.videos = res.data[0].videos
                this.article.year = res.data[0].year
                if (res.data[0].photos) {
                  setTimeout(function () {
                    new Slider(document.querySelector('#slider-p'))
                  }, 90)
                }
                if (res.data[0].videos) {
                  setTimeout(function () {
                    new Player(document.querySelector('#video-p'), true)
                  }, 100)
                }
              } else {
                this.article.title = ''
                this.article.content = ''
                this.article.year = ''
                this.article.photos = []
                this.article.videos = []
              }
            }).catch(err => {
              console.log(err)
            })
          },
          getDetails (postId) {
            let form_data = new FormData
            form_data.append('action', 'get_exhibition')
            form_data.append('id', postId)
            this.loaderArticle = true
            axios.post(`${ajaxurl}`, form_data).then(res => {
              this.article.title = res.data.post_title
              this.article.content = res.data.content
              this.article.photos = res.data.photos
              this.article.videos = res.data.videos
              this.article.year = res.data.year
              this.loaderArticle = false
              if (res.data.photos) {
                setTimeout(function () {
                  new Slider(document.querySelector('#slider-p'))
                }, 90)
              }
              if (res.data.videos) {
                setTimeout(function () {
                  new Player(document.querySelector('#video-p'), true)
                }, 100)
              }
            }).catch(err => {
              console.log(err)
            })
          },
          setActiveProject (name, slug) {
            this.activeProject = name
            this.activeProjectSlug = slug
            this.getProjectsDetails()
          }
        }
      })
    }
  }
}