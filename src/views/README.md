# Custom templates

There are some custom templates that are defined for the views. These are all defined
in the filter:

    /src/hook_filters/taxonomy_templates.php

# All Templates (in order)

    -- Single --
    /src/views/layouts/single-$post_name.php
    /src/views/layouts/cpt-$post_type.php
    /src/views/layouts/cpt.php
    /src/views/layouts/page-$page_type.php

    -- Taxonomies --
    /src/views/layouts/taxonomy-$taxonomy.php
    /src/views/layouts/page-$post_type.php

    -- Terms --
    /src/views/layouts/term-$term.php
    /src/views/layouts/taxonomy-$taxonomy-term.php
    /src/views/layouts/page-$post_type.php


## Layouts

The layouts contain all of the page templates including custom post types, taxonomies, etc..

    /src/views/layouts


## Single Posts

Any single post for a custom post type can have one of the following templates, in this order
of usage:

### 1. single-$post_name.php

The post_name of the post can be used and will be the first to be checked for.

    /src/views/layouts/single-$post_name.php

    e.g.
    /src/views/layouts/single-height-balance.php

### 2. cpt-$post_type.php

This is the more generic custom-post-type template.

    /src/views/layouts/cpt-$post_tyle.php

    e.g.
    /src/views/layouts/cpt-syllabus.php

### 3. cpt.php

The catch-all for all custom post types.

    /src/views/layouts/cpt.php


### 4. page-$page_type.php (GLOBAL)

The catch-all global page-type for all pages/taxonomies/etc..

    /src/views/layouts/page-syllabus.php   


## Taxonomies

Each taxonomy has the following templates defined:

### 1. taxonomy-$taxonomy.php

This is the template for the custom taxonomy defined.

    /src/views/layouts/taxonomy-$taxonomy.php

    e.g.
    /src/views/layouts/taxonomy-syllabus_category.php

### 2. page-$page_type.php (GLOBAL)

The catch-all global page-type for all pages/taxonomies/etc..

    /src/views/layouts/page-$page_type.php

    e.g.
    /src/views/layouts/page-syllabus.php   


## Taxonomy Terms

Each taxonomy term has the following templates defined:

### 1. term-$term.php

The specific term for the taxonomy can be referenced with the 
following template:

    /src/views/layouts/term-$term.php

    e.g.
    /src/views/layouts/term-balancing.php


### 2. taxonomy-$taxonomy-term.php

The generic term for the taxonomy can be referenced with the 
following template:

    /src/views/layouts/taxonomy-$taxonomy-term.php

    e.g.
    /src/views/layouts/taxonomy-syllabus_category-term.php

### 3. page-$page_type.php (GLOBAL)

The catch-all global page-type for all pages/taxonomies/etc..

    /src/views/layouts/page-$page_type.php

    e.g.
    /src/views/layouts/page-syllabus.php   


# Registering

All of these templates are agnostic to the CPT and therefore can apply to any.

However, the class must be instantiated with the name of the taxonomy and the post type.

```php
/**
 * Register the template files to use with the custom taxonomies.
 */
new andyp\theme\syllabus\hook_filters\taxonomy_templates([
    'taxonomy' => 'syllabus_category',
    'post_type' => 'syllabus'
]);
```

This will then define the new directory in the theme folder and the templates to look for.