Dokuwiki plugin adultcontent
============================

This simple plugin checks a page when it is saved, and stores an "adult" flag
in the page metadata when the text contains one of the configured keywords.

You can retrieve this flag in your template and use it to control your
content, for example to leave out Google AdSense on medical pages that talk
about sexually transmitted diseases.

```php
<?php if (!p_get_metadata($ID, "adult")) { ?>

...

Your Google AdSense code...

...

<?php } ?>
```

Configuration
-------------

The keywords are a regular expression, so alternatives and groups work:

    sex|porn|orgy|19금

`#` is used as the pattern delimiter, which means slashes in the
configuration (URLs, "and/or", ...) do not need to be escaped. Leave the
setting empty to disable the check; the metadata is then left untouched.

An empty flag is written as false, so a page stops being flagged as soon as
the keyword is removed and the page is saved again.

https://www.dokuwiki.org/plugin:adultcontent
