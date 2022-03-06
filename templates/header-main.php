<?php
global $one_menu, $side_menu, $main_menu;

$current_post_id         = get_the_ID();
$container_style         = '';
$container_parallax      = '';
$page_class              = '';
$img_width_height_custom = '';
$main_menu               = '';
$one_menu                = '';
$side_menu               = '';

if ( Creativo()->settings( 'page_load_effect' ) ) {
	$page_class = 'animsition';
}

if ( 'default' !== get_post_meta( $current_post_id, 'pyre_main_menu', true ) ) {
	$main_menu = get_post_meta( $current_post_id, 'pyre_main_menu', true );
}

if ( 'default' !== get_post_meta( $current_post_id, 'pyre_one_menu', true ) ) {
	$one_menu = get_post_meta( $current_post_id, 'pyre_one_menu', true );
}

if ( 'default' !== get_post_meta( $current_post_id, 'pyre_side_menu', true ) ) {
	$side_menu = get_post_meta( $current_post_id, 'pyre_side_menu', true );
}

$header_class       = ( Creativo()->settings( 'enable_sticky' ) ) ? 'sticky_h' : '';
$header_menu_modern = ( Creativo()->settings( 'enable_sticky_menu_modern' ) ) ? 'sticky_h_menu' : '';

if ( '1' === Creativo()->settings( 'en_parallax' ) ) {
	$container_style    = 'style="background-size: cover; background-attachment:fixed;"  data-stellar-background-ratio="0.1"';
	$container_parallax = ' parallax_class';
}

if ( 'Boxed' === Creativo()->settings( 'site_width' ) && get_post_meta( $current_post_id, 'pyre_background', true ) && 'yes' === get_post_meta( $current_post_id, 'pyre_en_full_screen', 'no' ) ) :
	?>
	<img id="background" src="<?php echo get_post_meta( $current_post_id, 'pyre_background', true ); ?>" class="bgwidth">
	<?php
endif;

// Add custom width if header left/right.
$container_margin = ( ( 'left' === Creativo()->settings( 'header_position' ) && 'no' !== get_post_meta( $post->ID, 'pyre_en_header', true ) ) || ( 'right' === Creativo()->settings( 'header_position' ) && 'no' !== get_post_meta( $post->ID, 'pyre_en_header', true ) ) ) ? 'data-container-width=' . str_replace( 'px', '', Creativo()->settings( 'hlr_width' ) ) . '' : 'data-container-width=0';

$container_id = '';
if ( is_page_template( 'page-one-full.php' ) ) {
	$container_id = 'home';
} else {
	$container_id = 'container';
}
?>
<div id="<?php echo esc_attr( $container_id ); ?>" class="container <?php echo $page_class . $container_parallax; ?>" <?php echo $container_style; ?> <?php echo $container_margin . ' data-container-pos=' . Creativo()->settings( 'header_position' ); ?>>
<?php
if ( Creativo()->settings( 'en_top_bar' ) && ( 'no' !== get_post_meta( $current_post_id, 'pyre_en_topbar', true ) ) ) {
	$top_nav_class = ( is_singular( 'post' ) && Creativo()->settings( 'top_bar_posts_disable' ) === 1 && ( get_post_meta( $current_post_id, 'pyre_en_topbar', true ) !== 'yes' ) ) ? 'hide_top_bar' : 'display_top_bar';
	?>
	<div class="top_nav_out <?php echo $top_nav_class; ?>">
		<div class="top_nav clearfix">
			<?php
			if ( 'Leave Empty' !== Creativo()->settings( 'tb_left_content' ) ) {
				?>
				<div class="tb_left">
					<?php
					if ( Creativo()->settings( 'tb_left_content' ) ) {
						if ( 'contactinfo' === Creativo()->settings( 'tb_left_content' ) ) {
							get_template_part( 'templates/header', 'contact-info' );
						} elseif ( 'socialinks' === Creativo()->settings( 'tb_left_content' ) ) {
							creativo_social_icons_wrap();
						} elseif ( 'nav' === Creativo()->settings( 'tb_left_content' ) ) {
							get_template_part( 'templates/header', 'top-menu' );
						}
					} else {
						get_template_part( 'templates/header', 'contact-info' );
					}
					?>
				</div>
				<?php
			}

			if ( 'left' === Creativo()->settings( 'tb_foce_social_icons' ) ) {
				?>
				<div class="tb_left separator_left">
					<?php get_template_part( 'templates/header', 'social-links' ); ?>
				</div>
				<?php
			}

			if ( 'Leave Empty' !== Creativo()->settings( 'tb_right_content' ) ) {
				?>
				<div class="tb_right">
					<?php
					if ( Creativo()->settings( 'tb_right_content' ) ) {
						if ( 'contactinfo' === Creativo()->settings( 'tb_right_content' ) ) {
							get_template_part( 'templates/header', 'contact-info' );
						} elseif ( 'socialinks' === Creativo()->settings( 'tb_right_content' ) ) {
							creativo_social_icons_wrap();
						} elseif ( 'nav' === Creativo()->settings( 'tb_right_content' ) ) {
							get_template_part( 'templates/header', 'top-menu' );
						}
					} else {
						get_template_part( 'templates/header', 'social-links' );
					}
					?>
				</div>
				<?php
			}
			if ( 'right' === Creativo()->settings( 'tb_foce_social_icons' ) ) {
				?>
				<div class="tb_right separator_right">
					<?php get_template_part( 'templates/header', 'social-links' ); ?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}
?>
<?php
if ( ( 'left' === Creativo()->settings( 'header_position' ) ) || ( 'right' === Creativo()->settings( 'header_position' ) ) ) {
	?>
	<?php
	$elem_pos = Creativo()->settings( 'side_blocks' )['enabled'];
	$elem_pos = str_replace( ' ', '-', array_map( 'strtolower', array_slice( $elem_pos, 1, ( count( $elem_pos ) - 1 ) ) ) );
	?>
	<header class="header_inside_<?php echo Creativo()->settings( 'header_position' ); ?> <?php echo $header_class; ?>">
		<div class="side_inside desktop_view">
			<?php
			foreach ( $elem_pos as $elem_pos_key ) {
				if ( 'social-links' === $elem_pos_key ) {
					?>
					<div class="side_social">
						<?php get_template_part( 'templates/global/social', 'links' ); ?>
					</div>
          <div class="side_hours" style="color: white;">
            Monday 10am-6:30pm<br />
    Tuesday 10am-6:30pm<br />
    Wednesday 10am-6:30pm<br />
    Thursday 10am-6:30pm<br />
    Friday 10am-6:30pm
          </div>
					<?php
				} elseif ( 'contact-info' === $elem_pos_key ) {
					?>
					<div class="side_contact">
						<?php get_template_part( 'templates/header', $elem_pos_key ); ?>
					</div>
					<?php
				} else {
					get_template_part( 'templates/header', $elem_pos_key );
				}
			}
			?>
		</div>
		<div class="side_inside mobile_view">
			<div class="side_contact">
				<?php get_template_part( 'templates/header', 'contact-info' ); ?>
			</div>

			<div class="side_social">
				<?php get_template_part( 'templates/global/social', 'links' ); ?>
			</div>
			<div class="side_logo">
				<?php get_template_part( 'templates/header', 'logo' ); ?>
			</div>
		</div>
	</header>
	<?php
} else {
	$transparent_class = '';
	$header_flex       = '';
	$transparency_js   = 'no';

	$resize_js     = ( Creativo()->settings( 'header_resize' ) ) ? 'yes' : 'no';
	$centered_js   = ( 'center' === Creativo()->settings( 'header_el_pos' ) ) ? 'yes' : 'no';
	$resize_factor = ( Creativo()->settings( 'resize_factor' ) ) ? Creativo()->settings( 'resize_factor' ) / 100 : 0.3;

	if ( Creativo()->settings( 'en_transparent_header' ) && 'yes' !== get_post_meta( $current_post_id, 'pyre_transparent_header', true ) ) {
		if ( is_singular( 'post' ) && 1 === Creativo()->settings( 'transparent_header_posts' ) && 'not' !== get_post_meta( $current_post_id, 'pyre_transparent_header', true ) ) {
			$transparent_class = 'header_transparent';
			$transparency_js   = 'yes';
		}
		if ( is_page() && 1 === Creativo()->settings( 'transparent_header_pages' ) && 'not' !== get_post_meta( $current_post_id, 'pyre_transparent_header', true ) ) {
			$transparent_class = 'header_transparent';
			$transparency_js   = 'yes';
		}
	} else {
		if ( 'yes' === get_post_meta( $current_post_id, 'pyre_transparent_header', true ) ) {
			$transparent_class = 'header_transparent';
			$transparency_js   = 'yes';
		}
	}
	$logo_resize = ( Creativo()->settings( 'logo_resize' ) ) ? 'yes' : 'no';

	$header_style = Creativo()->settings( 'header_style' );

	$individual_header = ( $current_post_id && '' !== get_post_meta( $current_post_id, 'pyre_header_style', true ) ) ? get_post_meta( $current_post_id, 'pyre_header_style', true ) : Creativo()->settings( 'header_style' );
	if ( 'default' === $individual_header || '' === $individual_header ) {
		$individual_header = Creativo()->settings( 'header_style' );
	}

	// Individual header el post.
	$header_el_pos = ( ! is_archive() && get_post_meta( $current_post_id, 'pyre_header_el_pos', true ) !== null ) ? get_post_meta( $current_post_id, 'pyre_header_el_pos', true ) : Creativo()->settings( 'header_el_pos' );

	if ( 'default' === $header_el_pos ) {
		$header_el_pos = Creativo()->settings( 'header_el_pos' );
	}

	$mobile_navigation = ( Creativo()->settings( 'mobile_menu_style' ) ) ? ' navigation_' . Creativo()->settings( 'mobile_menu_style' ) : '';
	?>

	<div class="full_header <?php echo $header_style; ?>">
		<div class="header_area <?php echo $header_class; ?>">
			<header class="header_wrap">
				<?php
				$sticky_mobile_menu = 'no';
				if ( Creativo()->settings( 'sticky_mobile_menu' ) ) {
					$sticky_mobile_menu = 'yes';
				}
				?>
				<div class="header <?php echo $transparent_class; ?>"
					mobile-design=<?php echo Creativo()->settings( 'mobile_menu_style' ); ?>
					header-version="<?php echo Creativo()->settings( 'header_style' ); ?>"
					data-centered="<?php echo $centered_js; ?>"
					data-resize="<?php echo $resize_js; ?>"
					resize-factor="<?php echo $resize_factor; ?>"
					data-transparent="<?php echo $transparency_js; ?>"
					logo-resize="<?php echo $logo_resize; ?>"
					sticky-mobile-menu="<?php echo esc_attr( $sticky_mobile_menu ); ?>">
					<div class="header_reduced">
						<div class="inner d-flex <?php echo $header_el_pos . $mobile_navigation; ?>">
							<div id="branding">
								<?php
								$transparent_logo = 'data-custom-logo="false"';
								if ( ( get_post_meta( $current_post_id, 'pyre_transparent_logo', true ) !== '' && get_post_meta( $current_post_id, 'pyre_transparent_header', true ) === 'yes' ) || ( get_post_meta( $current_post_id, 'pyre_transparent_header', true ) === 'yes' && Creativo()->settings( 'transparent_logo' ) ) ) {
									$logo_class       = 'hide_logo';
									$transparent_logo = 'data-custom-logo="true"';
								} else {
									$logo_class = 'show_logo';
									if ( Creativo()->settings( 'en_transparent_header' ) && Creativo()->settings( 'transparent_logo' ) ) {
										if ( is_singular( 'post' ) && Creativo()->settings( 'transparent_header_posts' ) === 1 && get_post_meta( $current_post_id, 'pyre_transparent_header', true ) !== 'not' ) {
											$logo_class       = 'hide_logo';
											$transparent_logo = 'data-custom-logo="true"';
										}
										if ( is_page() && Creativo()->settings( 'transparent_header_pages' ) === 1 && get_post_meta( $current_post_id, 'pyre_transparent_header', true ) !== 'not' ) {
											$logo_class       = 'hide_logo';
											$transparent_logo = 'data-custom-logo="true"';
										}
									}
								}

								$extra_logo_class = ( Creativo()->settings( 'retina_logo' ) ) ? 'normal_logo' : '';

								if ( Creativo()->settings( 'logo' ) || Creativo()->settings( 'retina_logo' ) ) {

									// Calculate the width and height of the logo if the Header resize is turned on.
									if ( Creativo()->settings( 'header_resize' ) ) {
										$default_logo           = Creativo()->settings( 'logo' );
										list( $width, $height ) = getimagesize( $default_logo );

										if ( '' !== get_post_meta( $current_post_id, 'pyre_transparent_logo', true ) || '' !== Creativo()->settings( 'transparent_logo' ) ) {
											$transparent_logo_url   = ( '' !== get_post_meta( $current_post_id, 'pyre_transparent_logo', true ) ) ? get_post_meta( $current_post_id, 'pyre_transparent_logo', true ) : Creativo()->settings( 'transparent_logo' );
											list( $width, $height ) = getimagesize( $transparent_logo_url );
										}

										if ( Creativo()->settings( 'logo_resize' ) && ! empty( Creativo()->settings( 'logo_resize_value' ) ) ) {
											$resize_value = str_replace( 'px', '', Creativo()->settings( 'logo_resize_value' ) );
											$logo_height  = round( ( $height * (int) $resize_value ) / $width );
										} else {
											$logo_height = $height;
										}

										$img_width_height        = 'logo-height="' . $logo_height . '"';
										$img_width_height_custom = 'logo-height="' . $height . '"';
									} else {
										$img_width_height = '';
									}

									$mobile_logo = ( Creativo()->settings( 'mobile_logo' ) ) ? 'mobile_logo_render' : '';
									$url         = home_url();

									if ( Creativo()->settings( 'en_custom_logo_url' ) && ! empty( Creativo()->settings( 'custom_logo_url' ) ) ) {
										$url = Creativo()->settings( 'custom_logo_url' );
									}
									?>
									<div class="logo <?php echo $mobile_logo; ?>" <?php echo $transparent_logo; ?>>
										<a href="<?php echo esc_attr( $url ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
										<?php
										if ( Creativo()->settings( 'logo' ) ) {
											?>
											<img src="<?php echo Creativo()->settings( 'logo' ); ?>" <?php echo $img_width_height; ?> alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" class="original_logo <?php echo $extra_logo_class; ?> <?php echo $logo_class; ?> <?php echo( Creativo()->settings( 'mobile_logo' ) ? 'desktop_logo' : '' ); ?>">
											<?php
											if ( ( get_post_meta( $current_post_id, 'pyre_transparent_logo', true ) !== '' ) && ( get_post_meta( $current_post_id, 'pyre_transparent_header', true ) === 'yes' ) ) {
												$extra_transparent_logo_class = ( get_post_meta( $current_post_id, 'pyre_transparent_logo_retina', true ) ) ? 'normal_logo' : '';
												?>
												<img src="<?php echo get_post_meta( $current_post_id, 'pyre_transparent_logo', true ); ?>" <?php echo $img_width_height_custom; ?>  alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" class="custom_logo <?php echo $extra_transparent_logo_class; ?> show_logo">
												<?php
											} elseif ( get_post_meta( $current_post_id, 'pyre_transparent_header', true ) === 'yes' && Creativo()->settings( 'transparent_logo' ) ) {
												?>
												<img src="<?php echo Creativo()->settings( 'transparent_logo' ); ?>" <?php echo $img_width_height_custom; ?>  alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" class="custom_logo <?php echo $extra_transparent_logo_class; ?> show_logo">
												<?php
											} else {
												if ( Creativo()->settings( 'en_transparent_header' ) ) {
													if ( get_post_meta( $current_post_id, 'pyre_transparent_header', true ) !== 'not' && ( ( is_singular( 'post' ) && Creativo()->settings( 'transparent_header_posts' ) === 1 ) || ( is_page() && Creativo()->settings( 'transparent_header_pages' ) === 1 ) ) && Creativo()->settings( 'transparent_logo' ) ) {
														$extra_transparent_logo_class = ( Creativo()->settings( 'transparent_logo_retina' ) ) ? 'normal_logo' : '';
														?>
														<img src="<?php echo Creativo()->settings( 'transparent_logo' ); ?>" <?php echo $img_width_height_custom; ?>  alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" class="custom_logo <?php echo $extra_transparent_logo_class; ?> show_logo">
														<?php
													}
												}
											}
										}

										if ( Creativo()->settings( 'retina_logo' ) ) {
											?>
											<img src="<?php echo Creativo()->settings( 'retina_logo' ); ?>" <?php echo $img_width_height; ?>  alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" class="original_logo retina_logo <?php echo $logo_class; ?> <?php echo( Creativo()->settings( 'mobile_logo' ) ? 'desktop_logo' : '' ); ?>">
											<?php
											if ( ( get_post_meta( $current_post_id, 'pyre_transparent_logo_retina', true ) !== '' ) && ( get_post_meta( $current_post_id, 'pyre_transparent_header', true ) === 'yes' ) ) {
												?>
												<img src="<?php echo get_post_meta( $current_post_id, 'pyre_transparent_logo_retina', true ); ?>" <?php echo $img_width_height; ?>  alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" class="custom_logo retina_logo show_logo">
												<?php
											} else {
												if ( Creativo()->settings( 'en_transparent_header' ) ) {
													if ( get_post_meta( $current_post_id, 'pyre_transparent_header', true ) !== 'not' && ( ( is_singular( 'post' ) && Creativo()->settings( 'transparent_header_posts' ) === 1 ) || ( is_page() && Creativo()->settings( 'transparent_header_pages' ) === 1 ) ) && Creativo()->settings( 'transparent_logo' ) ) {
														$extra_transparent_logo_class = ( Creativo()->settings( 'transparent_logo_retina' ) ) ? 'normal_logo' : '';
														?>
														<img src="<?php echo Creativo()->settings( 'transparent_logo_retina' ); ?>" <?php echo $img_width_height; ?>  alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" class="custom_logo retina_logo show_logo">
														<?php
													}
												}
											}
										}

										if ( Creativo()->settings( 'mobile_logo' ) ) {
											?>
											<img src="<?php echo Creativo()->settings( 'mobile_logo' ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" class="mobile_logo">
											<?php
										}
										?>
										</a>
									</div>
									<?php
								} else {
									$text_logo_tag = Creativo()->settings( 'text_logo_tag' ) ? Creativo()->settings( 'text_logo_tag' ) : 'h1';
									$text_logo_url = home_url();
									if ( Creativo()->settings( 'en_custom_logo_url' ) && ! empty( Creativo()->settings( 'custom_logo_url' ) ) ) {
										$text_logo_url = Creativo()->settings( 'custom_logo_url' );
									}
									?>
									<div class="text_logo">
										<<?php echo $text_logo_tag; ?> class="text">
											<a href="<?php echo esc_attr( $text_logo_url ); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></<?php echo $text_logo_tag; ?>>
											<?php
											if ( Creativo()->settings( 'en_tagline' ) ) {
												?>
											<div class="tagline"><?php echo get_bloginfo( 'description' ); ?></div>
												<?php
											}
											?>
									</div>
									<?php
								}
								?>
							</div>
							<?php
							if ( Creativo()->settings( 'logo_separator' ) ) {
								?>
								<div class="logo_separator"></div>
								<?php
							}
							?>
							<?php
							if ( 'style1' === $individual_header || 'business' === $individual_header ) {
								if ( 'style1' === $individual_header ) {
									?>
									<div class="header_right_side">
										<?php get_template_part( 'templates/header', 'navigation' ); ?>
									</div>
									<?php
								} else {
									get_template_part( 'templates/header', 'navigation' );
								}
							}
							?>
							<?php
							if ( 'style2' === $individual_header ) {
								if ( Creativo()->settings( 'modern_cta' ) ) {
									?>
									<div class="modern_cta">
										<span class="modern_cta_head_text"><?php echo Creativo()->settings( 'modern_cta_head_text' ); ?></span>
										<span class="modern_cta_phone_number"><a href="tel:<?php echo Creativo()->settings( 'modern_cta_phone' ); ?>"><?php echo Creativo()->settings( 'modern_cta_phone' ); ?></a></span>
									</div>
									<?php
								}
								if ( Creativo()->settings( 'modern_social_icons' ) ) {
									?>
									<div class="modern_social_icons <?php echo Creativo()->settings( 'modern_si_shape' ); ?>"><?php get_template_part( 'templates/global/social', 'links' ); ?></div>
									<?php
								}
								if ( '' !== Creativo()->settings( 'header_banner' ) ) {
									?>
									<div class="banner">
										<?php echo Creativo()->settings( 'header_banner' ); ?>
									</div>
									<?php
								}
							}

							if ( 'modern' === Creativo()->settings( 'mobile_menu_style' ) ) {
								?>
								<div class="modern_mobile_navigation">
									<?php echo mobile_menu_navigation_modern(); ?>
								</div>
								<div class="modern_mobile_wrapper">
									<?php echo mobile_menu_holder(); ?>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
			</header>
			<?php
			if ( 'style2' === $individual_header ) {
				?>
				<div class="second_navi <?php echo $header_menu_modern; ?>">
					<div class="second_navi_inner <?php echo Creativo()->settings( 'header_modern_el_pos' ); ?>">
						<nav id="navigation" class="main_menu">
							<?php
							if ( is_page_template( 'page-one-full.php' ) || is_page_template( 'page-one-full-modern.php' ) ) {
								wp_nav_menu(
									array(
										'theme_location' => 'one-page-menu',
										'menu'           => $one_menu,
										'container'      => false,
										'items_wrap'     => '<ul id="one_page_navigation" class="%2$s">%3$s</ul>',
										'fallback_cb'    => 'default_menu_fallback',
										'walker'         => new Creativo_Megamenu_Walker(),
									)
								);
							} else {
								wp_nav_menu(
									array(
										'theme_location' => 'primary-menu',
										'menu'           => $main_menu,
										'container'      => false,
										'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
										'fallback_cb'    => 'default_menu_fallback',
										'walker'         => new Creativo_Megamenu_Walker(),
									)
								);
							}
							?>
							<form action="<?php echo home_url(); ?>" method="get" class="header_search">
								<input type="text" name="s" class="form-control" value="" placeholder="<?php esc_attr_e( 'Type &amp; Hit Enter..', 'Creativo' ); ?>">
							</form>
						</nav>
						<?php
						if ( Creativo()->settings( 'header_extra_button' ) ) {
							?>
							<div class="extra_header_button"><a href="<?php echo Creativo()->settings( 'header_cta_link' ); ?>" class="header_button" target="<?php echo Creativo()->settings( 'header_cta_link_target' ); ?>"><?php echo Creativo()->settings( 'header_cta_text' ); ?></a></div>
							<?php
						}
						?>
						<div class="additional_icons">
							<ul>
								<?php
								creativo_header_menu_extra_icons();
								?>
							</ul>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}
if ( Creativo()->settings( 'mobile_menu_style' ) !== 'modern' ) {
	echo mobile_menu_navigation_classic();
}
