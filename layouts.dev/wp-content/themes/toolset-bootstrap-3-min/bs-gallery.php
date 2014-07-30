<?php
/**
 * Twitter Bootstrap compatibile [gallery] shortcode,
 *
 */

if ( !function_exists( 'wpbootstrap_gallery' ) ) {

	function wpbootstrap_gallery( $content, $attr ) {

		global $instance, $post;
		$instance++;

		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );

			if ( !$attr['orderby'] ) {
				unset( $attr['orderby'] );
			}
		}

		extract( shortcode_atts( array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'div',
			'captiontag' => 'div',
			'columns'    => 3,
			'size'       => 'thumbnail',
			'include'    => '',
			'exclude'    => '',
						), $attr ) );

		$id = intval( $id );
		if ( 'RAND' == $order ) {
			$orderby = 'none';
		}

		if ( $include ) {
			$include      = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts(array(
				'include'        => $include,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $order,
				'orderby'        => $orderby
			));

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[ $val->ID ] = $_attachments[ $key ];
			}
		}
		elseif ( $exclude ) {
			$exclude     = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children(array(
				'post_parent'    => $id,
				'exclude'        => $exclude,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $order,
				'orderby'        => $orderby
			));
		} else {
			$attachments = get_children(array(
				'post_parent'    => $id,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $order,
				'orderby'        => $orderby
			));
		}

		if ( empty( $attachments ) ) {
			return;
		}
		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment ) {
				$output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
			}
			return $output;
		}

		$itemtag    = tag_escape( $itemtag );
		$captiontag = tag_escape( $captiontag );
		$columns    = intval(min( array( 12, $columns ) ) );
		$float      = ( is_rtl() ) ? 'right' : 'left';

		if ( 3 > $columns ) {
			$size = 'full';
		}
		elseif ( 5 > $columns ) {
			$size = 'medium';
		}
		$selector   = "gallery-{$instance}";
		$size_class = sanitize_html_class( $size );
		$output     = "<section id='$selector' class='row gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class} clearfix'>";

		$i = 0;
		foreach ( $attachments as $id => $attachment ) {
			$comments = get_comments(array(
				'post_id' => $id,
				'count'   => true,
				'type'    => 'comment',
				'status'  => 'approve'
			));

			$link = wp_get_attachment_link( $id, $size, ! ( isset( $attr['link'] ) AND 'file' == $attr['link'] ) );
			$gallerylink = preg_replace( '/<a(.*?<img)(.*?.)(width|height)=\"\d*\"\s(src=\".*?\")\s(class=.)(.*?)/', '<a$1 $4 $5img-responsive $6', $link );
			$clear_class = ( 0 == $i++ % $columns ) ? ' clear' : '';
			$span        = 'col-sm-' . floor( 12 / $columns );
			$output     .= "<div class='{$span}{$clear_class}'><{$itemtag} class='gallery-item thumbnail'>";
			$output     .= "{$gallerylink}\n";

			if ( $captiontag AND ( 0 < $comments OR trim( $attachment->post_excerpt ) ) ) {
				$comments = ( 0 < $comments ) ? sprintf( _n( '%d comment', '%d comments', $comments, 'wpbootstrap' ), $comments ) : '';
				$excerpt  = wptexturize( $attachment->post_excerpt );
				$out      = ( $comments AND $excerpt ) ? " $excerpt <br /> $comments " : " $excerpt$comments ";
				$output  .= "<{$captiontag} class='wp-caption-text gallery-caption caption'>" . "<p>{$out}</p>" . "</{$captiontag}>\n";
			}
			$output .= "</{$itemtag}></div>\n";
		}
		$output .= "</section>\n";

		return $output;
	}

	add_filter( 'post_gallery', 'wpbootstrap_gallery', 10, 2 );
}