class News {
  constructor () {
    const news = document.querySelector('#news')
    if (news) {
      new Vue({
        el: '#news',
        data: {
          categories: [],
          articles: {},
          activeCategory: 'all',
          offset: 0,
          loading: false,
          loaderHeight: '400px'
        },
        mounted () {
          this.getCategories()
          this.getArticles('all')
        },
        methods: {
          getCategories () {
            let form_data = new FormData
            form_data.append('action', 'get_news_categories')
            this.loading = true
            axios.post(`${ajaxurl}`, form_data).then(res => {
              this.categories = res.data
              this.loading = false
            }).catch(err => {
              console.log(err)
            })
          },
          getArticles (category) {
            this.activeCategory = category
            let form_data = new FormData
            form_data.append('action', 'get_news')
            form_data.append('category', category)
            form_data.append('offset', this.offset)
            this.loading = true
            this.loaderHeight = `${document.querySelector('.news-container').offsetHeight}px`
            axios.post(`${ajaxurl}`, form_data).then(res => {
              if (this.articles.length > 0) {
                res.data.forEach(e => {
                  this.articles.push(e)
                })
              } else {
                this.articles = res.data
              }
              this.loading = false
            }).catch(err => {
              console.log(err)
            })
          },
          changeCategory (category) {
            this.articles = []
            this.offset = 0
            this.getArticles(category)
            
          },
          loadMore () {
            this.offset += 8
            this.getArticles(this.activeCategory)
          },
        }
      })
    }
  }
}