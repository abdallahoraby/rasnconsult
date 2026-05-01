(function($) {
    "use strict";

    $(document).ready(function() {
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            easing: 'ease-in-out',
        });

        // Transparent header: add scrolled class on scroll
        var $header = $('.header--transparent');
        if ( $header.length ) {
            $(window).on('scroll.header', function() {
                if ( $(this).scrollTop() > 60 ) {
                    $header.addClass('header--scrolled');
                } else {
                    $header.removeClass('header--scrolled');
                }
            });
            $(window).trigger('scroll.header');
        }

        // Blogs Infinite Scroll
        var $blogsSection = $('#blogs-section');
        if ($blogsSection.length) {
            var $container = $('#blogs-container');
            var $loader = $('#blogs-loader');
            var ajaxUrl = $blogsSection.data('ajax-url');
            var postsPerPage = parseInt($blogsSection.data('posts-per-page'));
            var totalPages = parseInt($blogsSection.data('total-pages'));
            var currentPage = 1;
            var isLoading = false;

            $(window).on('scroll.blogs', function() {
                if (isLoading || currentPage >= totalPages) return;

                var scrollPos = $(window).scrollTop() + $(window).height();
                var sectionBottom = $blogsSection.offset().top + $blogsSection.height();

                if (scrollPos > sectionBottom - 200) {
                    isLoading = true;
                    $loader.show();
                    currentPage++;

                    $.ajax({
                        url: ajaxUrl,
                        type: 'POST',
                        data: {
                            action: 'rasn_load_more_posts',
                            page: currentPage,
                            posts_per_page: postsPerPage
                        },
                        success: function(response) {
                            if (response) {
                                var $newItems = $(response);
                                $container.append($newItems);
                                // Refresh AOS
                                if (window.AOS) {
                                    AOS.refresh();
                                }
                            }
                            $loader.hide();
                            isLoading = false;
                        },
                        error: function() {
                            $loader.hide();
                            isLoading = false;
                        }
                    });
                }
            });
        }
    });

})(jQuery);
