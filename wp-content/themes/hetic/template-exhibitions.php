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
                        <button class="list-years" @click="setActiveYear(year.name)"
                                :class="{active:activeYear == year.name}">{{ year.name }}
                        </button>
                    </li>
                </ul>
                </ul>
            </header>
            <div class="row">
                <div class="item-container menu">
                    <h4 class="item-title menu-title">Exhibitions {{ activeYear }}</h4>
                    <ul class="list-exhibtions">
                        <li class="exhibition-item" v-for="exhibition in exhibitions">
                            <button class="exhibition-item-link" @click="getArticle(exhibition.ID)">{{ exhibition.city
                                }} {{ exhibition.post_title }}
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="content" v-if="!loaderArticle">
                    <h1 class="content-title">{{ article.title }}</h1>
                    <p class="content-text">{{ article.content }}</p>
                </div>
                <div class="content" v-else>
                    <img src="<?php echo IMAGES_URL ?>/loader.svg" alt="Loader">
                </div>
            </div>
            <div class="row-slider slider-e" v-if="!loaderArticle && article.photos && article.photos.length > 0">
                <div class="slider-container">
                    <div class="slider-item" v-for="photo in article.photos">
                        <div class="slider-img" :style="{backgroundImage: `url(${photo.photo.url})`}"></div>
                    </div>
                </div>
                <div class="slider-nav">
                    <div class="slider-index">
                        <span class="slider-index-current">01</span>
                        /
                        <span class="slider-index-total">{{ article.photos.length }}</span>
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
            <div class="section-videos-wrapper-e" v-if="!loaderArticle && article && article.video">
                <div class="section-videos-wrapper-effect section-videos-wrapper-effect-play">
                    <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 5v14l11-7z" class="icon"/>
                    </svg>
                </div>
                <div class="section-videos-wrapper-effect section-videos-wrapper-effect-pause">
                    <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" class="icon"/>
                    </svg>
                </div>
                <video class="section-videos-wrapper-video" :src="article.video.url" controlsList="nodownload"></video>
                <button class="section-videos-wrapper-controls--fullscreen">
                    <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z"
                              class="icon"/>
                    </svg>
                </button>
                <div class="section-videos-wrapper-controls">
                    <button class="section-videos-wrapper-controls--skip section-videos-wrapper-controls--skip-prev hide">
                        <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 6h2v12H6zm3.5 6l8.5 6V6z" class="icon"/>
                            <path d="M0 0h24v24H0z" fill="none"/>
                        </svg>
                    </button>
                    <button class="section-videos-wrapper-controls--toggle">
                        <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 5v14l11-7z" class="icon"/>
                            <path d="M0 0h24v24H0z" fill="none"/>
                        </svg>
                    </button>
                    <button class="section-videos-wrapper-controls--skip section-videos-wrapper-controls--skip-next">
                        <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z" class="icon"/>
                            <path d="M0 0h24v24H0z" fill="none"/>
                        </svg>
                    </button>
                    <div class="section-videos-wrapper-controls--time section-videos-wrapper-controls--time-current">
                        00:00
                    </div>
                    <span class="section-videos-wrapper-controls--time section-videos-wrapper-controls--time-separation">/</span>
                    <div class="section-videos-wrapper-controls--time section-videos-wrapper-controls--time-duration">
                        00:00
                    </div>
                    <div class="section-videos-wrapper-controls-seek-bar">
                        <div class="section-videos-wrapper-controls-seek-bar--fill"></div>
                    </div>
                    <div class="section-videos-wrapper-controls-volume">
                        <button class="section-videos-wrapper-controls-volume--icon volume-2">
                            <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.5 12c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM5 9v6h4l5 5V4L9 9H5z"
                                      class="icon"/>
                                <path d="M0 0h24v24H0z" fill="none"/>
                            </svg>
                        </button>
                        <div class="section-videos-wrapper-controls-volume--bar">
                            <div class="section-videos-wrapper-controls-volume--bar-fill">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php get_footer(); ?>