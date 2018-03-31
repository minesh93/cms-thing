# cms-thing (AKA Claws)


## NPM Dependancies for building JS + CSS

```
flexboxgrid
vue-multiselect
vue-quill-editor
```


Add config file to use admin templates.

Claws.php 
 ```
    return [
        'admin_templates' => 'claws.admin.templates',
        'site_templates' => 'claws.site',
    ];
```

##Current Dilema of adding content
Right now there is no concrete way of adding content types so while this is being built I am dumping all the content type creation in routes.php

Adding types of content 
```
PostRegister::register([
    'name' => 'page',
    'urlBase' => '/',
    'useCustomTemplates' => true,
]);


PostRegister::register([
    'name' => 'post',
    'createText' => 'Write A New Post',
    'urlBase' => 'blog',
    'icon' => 'fa-thumbtack',
]);
```



