<?php /* Template Name: Template Exhibitions */ ?>

<?php get_header(); ?>
    <main class="main exhibitions" id="exhibitions">
        <div class="full-image">
            <img src="<?php echo IMAGES_URL ?>/JR-exhib.png" alt="JR exhibition">
        </div>
        <div class="container">
            <header class="header-scroll scroll-disable">
                <ul class="header-scroll-nav">
                    <li v-for="year in years">
                        <button class="active list-years" @click="setActiveYear(year.name)">{{ year.name }}</button>
                    </li>
                </ul>
                </ul>
            </header>
            <div class="row">
                <div class="item-container menu">
                    <h4 class="item-title menu-title">Exhibitions {{ year }}</h4>
                    <ul class="list-exhibtions">
                        <li class="exhibition-item" v-for="exhibition in exhibitions">
                            <button class="exhibition-item-link" @click="getArticle(exhibition.ID)">{{ exhibition.city }} {{ exhibition.post_title }}
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="content">
                    <h1 class="content-title">{{ article.title }}</h1>
                    <p class="content-text">{{ article.content }}</p>
                </div>
            </div>
            <div class="row-slider slider">
                <div class="slider-container">
                    <div class="slider-item">
                        <div class="slider-img"
                             style="background-image: url(<?php echo IMAGES_URL ?>/jr-atelier.jpg)"></div>
                    </div>
                    <div class="slider-item">
                        <div class="slider-img"
                             style="background-image: url(<?php echo IMAGES_URL ?>/jr-atelier.jpg)"></div>
                    </div>
                </div>
                <div class="slider-nav">
                    <div class="slider-index">
                        <span class="slider-index-current">01</span>
                        /
                        <span class="slider-index-total">01</span>
                    </div>
                    <div class="slider-timer">
                        <div class="slider-timer-fill"></div>
                    </div>
                    <div class="slider-controls">
                        <button class="slider-prev">
                            <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" class="icon"/>
                                <path d="M0 0h24v24H0z" fill="none"/>
                            </svg>
                        </button>
                        <button class="slider-next">
                            <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z" class="icon"/>
                                <path d="M0 0h24v24H0z" fill="none"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php get_footer(); ?>