(function ($) {
    kemet_responsive_spacing( 'kemet-settings[padding-inside-container]','.single-post .kmt-article-single , .single-post .kmt-comment-list li , .single-post .comments-area .comment-respond , .single-post .kmt-author-box-info', 'padding', ['top', 'right', 'bottom', 'left' ] );

    wp.customize('kemet-settings[title-meta-position]', function (value) {
        value.bind(function (align) {
            $('.single .entry-header').css('text-align' , align);
        });
    });

    wp.customize('kemet-settings[content-alignment]', function (value) {
        value.bind(function (align) {
            $('.single .entry-content , .single .comments-area , .single .comments-area .comment-form-textarea textarea').css('text-align' , align);
        });
    });
})(jQuery);