# Page Action: Include File

A generic action for Lister Pro allowing the selection of a PHP file containing the action code.

This can be useful for quickly applying API processing to pages without going to the trouble of creating a custom Page Action module for the purpose. Large quantities of pages can be processed thanks to Lister Pro's feature that splits the pages into chunks.

## Usage

The module creates a folder at `/site/templates/PageActionIncludeFile/` on install. Place your PHP files inside this folder. Within each file, the `$item` variable refers to the page that is currently being processed. There is no need to save the page within your code because Lister Pro does this automatically.

Example action file: `append_foo_to_page_title.php`
```php
<?php namespace ProcessWire;
/** @var Page $item */

// Append " foo" to page title
$item->title .= " foo";
```

Enable the PageActionIncludeFile action in the config of one or more Lister Pro instances.

![PageActionIncludeFile image 1](https://github.com/user-attachments/assets/26d894af-0f9b-4732-ab6f-19aa4dd0512f)

In the Lister Pro instance, set the filters or select the pages as needed and then choose the "Include File" action. Use the select field to choose a file you have added to `/site/templates/PageActionIncludeFile/`.

![PageActionIncludeFile image 2](https://github.com/user-attachments/assets/11880995-032a-4348-8bb2-aa1647f39731)

Click "Execute" apply the action.
