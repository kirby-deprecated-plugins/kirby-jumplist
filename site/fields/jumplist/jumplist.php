<?php

class JumpListField extends BaseField {

  static public $assets = array(
    "css" => array("jumplist.css"),
    "js" => array("jumplist.js")
  );

  public function content() {

/* Get current panel-edit-url */
/* Ref. http://stackoverflow.com/a/8891890 */

  function url_origin( $s, $use_forwarded_host = false ) {
    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $s['HTTP_HOST'] . $port;
    return $protocol . '://' . $host;
  }

  function full_url( $s, $use_forwarded_host = false ) {
    return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
  }

  $active_url = full_url( $_SERVER );

/* Initialize Kirby bootstrapper */

  $kirby = kirby();
  $site  = $kirby->site();

  $i = 0; /* Absolute pagenumbers */
  $z = 0; /* Column pagenumbers */
  $jumplist = null;
  $edit_slug = 'edit';

/* Get field settings */

    if(!c::get('kirbyJumplistLength')) {

      $kirbyJumplistLength = 10;

    } else {

      $kirbyJumplistLength = c::get('kirbyJumplistLength');

    }

    if(!c::get('kirbyJumplistSubmenu')) {

      $kirbyJumplistSubmenu = 1;

    } else {

      $kirbyJumplistSubmenu = c::get('kirbyJumplistSubmenu');

    }

    $pages = $site->pages();

    if(c::get('kirbyJumplistHide')) {

      if(c::get('kirbyJumplistHide') == 1) {

        $pages = $site->pages()->visible();

      }

    }

/* Spit out the jumplist */

    foreach($pages as $page):
      $i++;
      $z++;
      $current_url = $site->url().'/panel/pages/'.$page->slug().'/';
      $active_class = strpos($active_url,$current_url) > -1?'active':'';
      $home_class = $page->isHomePage()?' home':'';

        if($z == 1) {
          $jumplist .= '<ul class="menu">';
        }

          $has_children = null;

          $children = $page->children();

          if(c::get('kirbyJumplistHide')) {

            if(c::get('kirbyJumplistHide') == 1) {

              $children = $page->children()->visible();

            }

          }

          if($children->count()) {
            $has_children = ' class="with_childs"';
          }

        $jumplist .= '<li'.$has_children.'><div><a class="'.$active_class.$home_class.'" href="'.$current_url.$edit_slug.'">'.$i.'. '.$page->title()->html();

/* Check if page has sub-pages #start */

        if($has_children && $kirbyJumplistSubmenu == 1) {

          $jumplist .= ' <i class="fa fa-chevron-down"></i></a>';
          $jumplist .= '<ol class="submenu">';
          $q = 0;
            foreach($children as $child):
            $q++;
            $current_url = $site->url().'/panel/pages/'.$page->slug().'/'.$child->slug().'/';
            $active_class = strpos($active_url,$current_url) > -1?'active':'';
              $jumplist .= '<li><a class="'.$active_class.'" href="'.$current_url.$edit_slug.'">'.$q.'. '.$child->title().'</a></li>';
            endforeach;
          $jumplist .= '</ol></div>';

        }

/* Check if page has sub-pages #end */

        else {
          $jumplist .= '</a></div>';
        }

        $jumplist .= '</li>';

/* Rewind the countings */

        if ($z == $kirbyJumplistLength) {
          $jumplist .= '</ul>';
          $z = 0;
        }

    endforeach;

/* Force list close-tag, when needed */

    if ($z != 0) {
      $jumplist .= '</ul>';
    }

/* Write down the jumplist */

    return '<nav id="jumplist" data-field="jumplistfield"><i class="fa fa-file-text"></i><div class="menus_wrapper">'.$jumplist.'</div></nav>';

  }

/* #ID the parent-wrapper (.js manipulation) */

  public function element() {
    $element = parent::element();
    $element->addClass("field-jumplist");
    return $element;
  }
}

?>