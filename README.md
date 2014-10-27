
Dokuwiki plugin adultcontent
============================

This simple plugin will check your dokuwiki page before being saved whether it contains given keywords like "sex", "porn", "orgy", etc and puts the "adult" flag in metadata. 



You can retrieve this flag in your template and might control your contents like Google AdSense.

<code>

<?php  if (!p_get_metadata($ID,"adult")) {?>

...

Your Google AdSense code...

...

<?php } ?>
</code>

https://www.dokuwiki.org/plugin:adultcontent
 
I just have a few pages which has medical information about sexually transmitted disease, but Google AdSense does not like them.
so I made this plugin.
