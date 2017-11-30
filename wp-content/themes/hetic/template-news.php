<?php /* Template Name: Template News */ ?>

<?php get_header(); ?>
    <main class="main news" id="news">
        <header class="news-header">
            <ul>
                <li>
                    <button @click="changeCategory('all')" :class="{active:activeCategory === 'all'}">All</button>
                </li>
                <li v-for="category in categories">
                    <button @click="changeCategory(category.name)" :class="{active:activeCategory === category.name}">{{
                        category.name }}
                    </button>
                </li>
            </ul>
        </header>
        <div class="news-container" v-if="!loading">
            <a :href="article.slug" title="article name" class="news-container-item item" v-for="article in articles">
                <div class="item-img" :style="{backgroundImage: 'url('+article.img+')'}"></div>
                <div class="item-content">
                    <div class="item-content-category">
                        <span v-for="category in article.categories">#{{category.name}} </span>
                    </div>
                    <div class="item-content-date">
                        {{ article.projectDate }}
                    </div>
                    <h4 class="item-content-title">
                        {{ article.post_title }}
                    </h4>
                    <p class="item-content-text">
                        {{ article.content }}
                    </p>
                </div>
            </a>
            <div class="row" v-if="offset + 8 < max">
                <button class="news-more" @click="loadMore">Load more</button>
            </div>
        </div>
        <div class="loader" v-else :style="{height: loaderHeight}">
            <img src="<?php echo IMAGES_URL ?>/loader.svg" alt="Loader">
        </div>
    </main>
    <style>
        .loader {
            display: flex;
            justify-content: center;
            align-content: center;
        }
    </style>
<?php get_footer(); ?>