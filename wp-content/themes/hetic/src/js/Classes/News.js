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
          offset: 0
        },
        mounted () {
          this.getCategories()
          this.getArticles('all')
        },
        methods: {
          getCategories () {
            let form_data = new FormData
            form_data.append('action', 'get_news_categories')
            axios.post(`${ajaxurl}`, form_data).then(res => {
              this.categories = res.data
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
            axios.post(`${ajaxurl}`, form_data).then(res => {
              if (this.articles.length > 0) {
                res.data.forEach(e => {
                  this.articles.push(e)
                })
              } else {
                this.articles = res.data
              }
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