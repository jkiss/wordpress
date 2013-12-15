<div class="comments">
<?php if( comments_open()): ?>
<div id="respond">
    
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        <div class="commentinfobox">

        <?php if($user_ID): ?>
            <div class="logined">已登录：
                <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php">
                    <?php echo $user_identity; ?>
                </a>，&nbsp;
                <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">
                    注销
                </a>？
            </div>
        <?php else: ?>
            <div class="commentinfo">
                <label for="author">昵称：</label>
                <input type="text" name="author" id="author" required="true" />
            </div>
            <div class="commentinfo">
                <label for="email">E-mail：</label>
                <input type="email" name="email" id="email" required="true" />
            </div>
            <div class="commentinfo">
                <label for="url">你的博客：</label>
                <input type="text" name="url" id="url" />
            </div>
        <?php endif; ?>
    
            <div class="comment-textarea">
                <textarea name="comment" required="true" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click(); return false;}"></textarea>
            </div>
            <div class="comment-submit">
                <input type="submit" name="submit" id="submit" value="OK,说了" />
            </div>
        </div>
        <?php comment_id_fields(); ?>
        <?php do_action('comment_form', $post->ID); ?>
    </form>
</div>
<?php endif; ?>



<?php if(have_comments()): ?>
<?php 
function comment_list($comment, $args, $depth){
    $GLOBALS['comment'] = $comment;
    $parent_id = $comment->comment_parent;

?>
    <div class="comments-box">
        
        <div class="comment-box" id="comment-<?php comment_ID(); ?>">
            <div class="comment-split1"></div>
            <div class="comment-split2"></div>
            <img src="<?php bloginfo('template_directory'); ?>/images/avatar.jpg" />

            <div class="content">
                <span class="author-name"><?php comment_author_link(); ?>&nbsp;</span>
                <span class="author-time">发表于：<?php echo get_comment_date(); ?></span>
                <?php global $user_ID; if($user_ID): ?>
                    <span class="reply">
                        <?php comment_reply_link(array_merge($args, array('reply_text'=>'回复', 'depth'=>$depth, 'max_depth'=>$args['max_depth']))); ?>
                    </span>
                <?php endif;?>
                <span class="cancel_comment_reply">
		            <?php cancel_comment_reply_link('取消回复'); ?>
	            </span>
                <?php if($comment->comment_approved=='0'): ?>
                    <p class="moderation"><?php _e('Your comment is waiting for moderation...'); ?></p>
                <?php endif; ?>
                <div class="author-content">
                    <?php comment_text(); ?>
                </div>
            </div>                
        </div>  

        <div class="my-respond">
            <?php comment_text(); ?>
            <div class="my-triangle"></div>
            <img src="<?php bloginfo('template_directory')?>/images/my_avatar.jpg"/>
        </div>           
                      
    </div>

<?php
    }
    wp_list_comments("type=comment&callback=comment_list");
?>
<?php endif; ?>
</div>
