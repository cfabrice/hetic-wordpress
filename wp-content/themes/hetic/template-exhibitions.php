<?php /* Template Name: Template Exhibitions */ ?>

<?php get_header(); ?>
    <main class="main exhibitions">
        <div class="full-image">
            <img src="<?php echo IMAGES_URL ?>/JR-exhib.png" alt="JR exhibition">
        </div>
        <div class="container">
            <header class="header-scroll scroll-disable">
                <ul class="header-scroll-nav">
                    <?php
                    $terms = get_terms('years', [
                        'hide_empty' => false,
                        'orderby'    => 'name',
                        'order'      => 'DESC'
                    ]);
                    if( ! empty($terms) && ! is_wp_error($terms)){
                        $year = $terms[0]->name;
                        foreach($terms as $term){
                            echo '<li><button class="active list-years">' . $term->name . '</button></li>';
                        }
                    }
                    ?>
                </ul>
            </header>
            <script>
                jQuery(document).ready(function ($) {
                    let year = '<?php echo $year; ?>',
                        listYears = document.querySelectorAll('.list-years'),
                        titleYear = document.querySelector('.title-year'),
                        listExhibitions = document.querySelector('.list-exhibtions'),
                        contentTitle = document.querySelector('.content-title'),
                        contentText = document.querySelector('.content-text'),
                        exhibitionsLinks

                    getExhibitions(year)

                    listYears.forEach(year => {
                        year.addEventListener('click', (e) => {
                            getExhibitions(year.innerText)
                        })
                    })

                    function getExhibitions(year) {
                        jQuery.ajax({
                            type: "POST",
                            url: ajaxurl,
                            data: {
                                action: "get_exhibitions",
                                year: year
                            },
                            success: function (data) {
                                // Suppression des anciennes exhbitions
                                while (listExhibitions.firstChild) {
                                    listExhibitions.removeChild(listExhibitions.firstChild);
                                }
                                const exhib = JSON.parse(data)
                                // Mise à jour de la date dans le titre
                                titleYear.innerText = year
                                exhib.forEach(e => {
                                    let li = document.createElement('li');
                                    li.innerHTML = '<button data-id="' + e.ID + '" class="exhibition-item-link">' + e.city + ' - ' + e.post_title + '</button>'
                                    li.className = 'exhibition-item';
                                    listExhibitions.appendChild(li);
                                })
                                if (exhib[0]) {
                                    setActiveArticle(exhib[0])
                                } else {
                                    contentTitle.innerText = ''
                                    contentText.innerText = ''
                                }
                                exhibitionsLinks = document.querySelectorAll('.exhibition-item-link')
                                setTimeout(function () {
                                    listenToExhibitionClick()
                                }, 100)
                            },
                            error: function (errorThrown) {
                                console.log('err : ' + errorThrown);
                            }
                        });
                    }

                    function listenToExhibitionClick() {
                        exhibitionsLinks.forEach(item => {
                            item.addEventListener('click', (e) => {
                                fetchArticle(e.target.dataset.id)
                            })
                        })
                    }

                    function setActiveArticle(post) {
                        contentTitle.innerHTML = post.post_title
                        contentText.innerText = post.content
                    }

                    function fetchArticle(postId) {
                        jQuery.ajax({
                            type: "GET",
                            url: ajaxurl,
                            data: {
                                action: "get_exhibition",
                                id: postId
                            },
                            success: function (data) {
                                data = JSON.parse(data)
                                setActiveArticle(data)
                            },
                            error: function (errorThrown) {
                                console.log('err : ' + errorThrown);
                            }
                        });
                    }
                })
            </script>
            <div class="row">
                <div class="item-container menu">
                    <h4 class="item-title menu-title">Exhibitions <span class="title-year"></span></h4>
                    <ul class="list-exhibtions"></ul>
                </div>
                <div class="content">
                    <h1 class="content-title"></h1>
                    <p class="content-text"></p>
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