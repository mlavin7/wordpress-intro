<li data-id="<?php esc_attr_e( $post_id );?>">
    <div class="betterdocs-single-list-content">
        <span>
            <svg width="8px" viewBox="0 0 23 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="drag-dots" fill="#C5C5C5" fill-rule="nonzero"><path d="M4,0 C1.79947933,0 0,1.79947933 0,4 C0,6.20052067 1.79947933,8 4,8 C6.20052067,8 8,6.20052067 8,4 C8,1.79947933 6.20052067,0 4,0 Z M4,17 C1.79947933,17 0,18.7994793 0,21 C0,23.2005207 1.79947933,25 4,25 C6.20052067,25 8,23.2005207 8,21 C8,18.7994793 6.20052067,17 4,17 Z M4,34 C1.79947933,34 0,35.7994793 0,38 C0,40.2005207 1.79947933,42 4,42 C6.20052067,42 8,40.2005207 8,38 C8,35.7994793 6.20052067,34 4,34 Z M19,0 C16.7994793,0 15,1.79947933 15,4 C15,6.20052067 16.7994793,8 19,8 C21.2005207,8 23,6.20052067 23,4 C23,1.79947933 21.2005207,0 19,0 Z M19,17 C16.7994793,17 15,18.7994793 15,21 C15,23.2005207 16.7994793,25 19,25 C21.2005207,25 23,23.2005207 23,21 C23,18.7994793 21.2005207,17 19,17 Z M19,34 C16.7994793,34 15,35.7994793 15,38 C15,40.2005207 16.7994793,42 19,42 C21.2005207,42 23,40.2005207 23,38 C23,35.7994793 21.2005207,34 19,34 Z" id="Shape"></path></g></g></svg>
        </span>

        <?php if ( $edit_post_link ): ?>
            <a href="post.php?action=edit&post=<?php esc_attr_e( $post_id );?>">
        <?php else: ?>
            <span class="betterdocs-article-title">
        <?php endif;?>

        <?php
            echo betterdocs()->template_helper->kses( get_the_title() );

            if ( $post_status !== 'publish' ) {
                echo wp_kses_post( ' <span class="betterdocs-draft">' . $post_status . '</span>' );
            }
        ?>

        <?php if ( $edit_post_link ): ?>
            </a>
        <?php else: ?>
            </span>
        <?php endif;?>

        <span>
            <a href="<?php esc_attr_e( $permalink );?>" target="_blank" title="View Docs"><span class="dashicons dashicons-external"></span></a>
            <?php if ( $edit_post_link ): ?>
                <a href="post.php?action=edit&post=<?php esc_attr_e( $post_id );?>" title="Edit Docs"><span class="dashicons dashicons-edit"></span></a>
            <?php endif;?>

            <?php if ( $delete_post_link ): ?>
                <a href="<?php esc_attr_e( esc_url( $delete_post_link ) );?>" title="Delete Docs"><span class="dashicons dashicons-trash"></span></a>
            <?php endif;?>
        </span>
    </div>
</li>
