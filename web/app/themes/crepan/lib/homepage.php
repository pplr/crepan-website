<?php

class CrepanHomepage{
   public static $hot_news_image_size = 'homepage-hotnews';

   public static function addImageSize(){
     add_image_size(self::$hot_news_image_size, 800, 600, true);
   }

}


add_action( 'after_setup_theme', function(){CrepanHomepage::addImageSize();} );
