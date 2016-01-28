# Castlegate IT WP CMB SEO #

**Development of this plugin has now stopped. We now recommend [Advanced Custom Fields](http://www.advancedcustomfields.com/) for all custom WordPress fields.**

Simple SEO fields for titles, headings, and descriptions. The title and description fields (`seo_title` and `seo_description`) are displayed automatically. The heading `seo_heading` must be added the (child) theme template manually. The plugin provides the function `cgit_seo_heading()` to output the heading with a fallback to the post title or the site name. Alternatively, you can access the SEO heading directly with `get_field('seo_heading')` or `get_post_meta($post->ID, 'seo_heading', TRUE)`.

Use the `cgit_seo_fields` filter to edit the SEO fields (e.g. to add support for custom post types). Requires the [Human Made Custom Meta Boxes plugin](https://github.com/humanmade/Custom-Meta-Boxes).
