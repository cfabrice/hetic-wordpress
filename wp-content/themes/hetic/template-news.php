<?php /* Template Name: Template News */ ?>

<?php get_header(); ?>
    <section class="section section-social">
        <div class="section-social-photo"
             style="background-image:url('<?php echo THEME_URL ?>/instagram/photo.jpg')"></div>
        <div class="section-social-content">
            <h2 class="section-social-content--title">
                <?php the_field('section_1_title') ?>
            </h2>
            <div class="section-social-content-about">
                <div class="section-social-content-about--img"
                     style="background-image:url('<?php echo IMAGES_URL ?>/JR-profile.jpg')"></div>
                <span class="section-social-content-about--name">
                <?php the_field('section_1_user_name') ?>
            </span>
            </div>
            <div class="section-social-content--text">
                <p>
                    <?php
                    $str  = file_get_contents(THEME_URL . '/instagram/instagram.json');
                    $json = json_decode($str);
                    echo $json->desc
                    ?>
                </p>
            </div>
            <div class="section-social-content--date">
                <time id="instagramDate" datetime="<?php echo $json->photoTime ?>"></time>
            </div>
        </div>
    </section>
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
            <div class="row">
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