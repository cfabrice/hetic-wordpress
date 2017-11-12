class Exhibitions {
  constructor () {
    const exhibitions = document.querySelector('#exhibitions')
    if (exhibitions) {
      new Vue({
        el: '#exhibitions',
        data: {
          years: [],
          year: '',
          article: {
            title: '',
            content: ''
          },
          exhibitions: [],
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
            form_data.append('year', this.year)
            
            axios.post(`${ajaxurl}`, form_data).then(res => {
              this.exhibitions = res.data
              if (res.data.length > 0) {
                this.article.title = res.data[0].post_title
                this.article.content = res.data[0].content
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
            axios.post(`${ajaxurl}`, form_data).then(res => {
              this.article.title = res.data.post_title
              this.article.content = res.data.content
            }).catch(err => {
              console.log(err)
            })
          },
          setActiveYear (year) {
            this.year = year
            this.getExhibitions(this.year)
          }
        }
      })
    }
  }
}