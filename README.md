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

## Binding Content
Currently different posts types are assigned to the AppService Provider within the boot method.

Adding types of content or settings
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

        PostRegister::addPostRenderTemplate('page','Custom Page Template','custom-page');
        PostRegister::addPostContentTemplate('page','content_test', 'test-content' );
        PostRegister::addPostContentTemplate('page','only_page_type', 'test-content-1', 'custom-page');

        SettingsRegister::addSection('general','General','general');
        // SettingsRegister::addSection('test','Test');
```



